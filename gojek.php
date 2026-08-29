<?php
/**
 * Gojek Auto Register & Claim Voucher - Updated Version 2025
 * Kompatibel dengan Termux Android
 * Author: Updated Version
 */

date_default_timezone_set('Asia/Jakarta');
error_reporting(0);

// Include fungsi helper
require_once 'func.php';

// Validasi PHP dan extension
if (version_compare(PHP_VERSION, '5.4.0') < 0) {
    echo color("red", "[-] PHP version minimal 5.4.0 diperlukan!\n");
    exit;
}

if (!extension_loaded('curl')) {
    echo color("red", "[-] CURL extension tidak terinstall!\n");
    exit;
}

// Header banner
echo color("red", "[]════════════════════════════════════════[]\n");
echo color("cyan", "[]   Gojek Auto Register & Claim Voucher   []\n");
echo color("cyan", "[]         Updated Version 2025            []\n");
echo color("red", "[]════════════════════════════════════════[]\n\n");

echo color("yellow", "[*] Started: " . date('[d-m-Y H:i:s]') . "\n");
echo color("yellow", "[*] Timezone: " . date_default_timezone_get() . "\n\n");

echo color("green", "[INFO] Format nomor:\n");
echo color("green", "  - Indonesia (62): 628123456789\n");
echo color("green", "  - Format Alternatif: +628123456789\n\n");

// Main function
function main() {
    $attempts = 0;
    $max_attempts = 3;
    
    while ($attempts < $max_attempts) {
        try {
            $attempts++;
            echo color("cyan", "\n[Attempt " . $attempts . "/" . $max_attempts . "]\n");
            
            // Input nomor telepon
            echo color("nevy", "► Masukkan nomor (62XXXXXXXXXX): ");
            $phone = trim(fgets(STDIN));
            
            if (empty($phone)) {
                echo color("red", "[-] Nomor tidak boleh kosong!\n");
                continue;
            }
            
            // Validasi format nomor
            $phone = sanitizePhone($phone);
            if (!validatePhone($phone)) {
                echo color("red", "[-] Format nomor salah! Gunakan format 62XXXXXXXXXX\n");
                continue;
            }
            
            echo color("green", "[+] Nomor valid: " . $phone . "\n");
            
            // Generate nama dan email
            $nama = generateName();
            $email = sanitizeString($nama) . mt_rand(100, 9999) . "@gmail.com";
            
            echo color("yellow", "[*] Nama: " . $nama . "\n");
            echo color("yellow", "[*] Email: " . $email . "\n");
            
            // Step 1: Register
            echo color("blue", "\n[STEP 1] Registering account...\n");
            $registerData = json_encode([
                'email' => $email,
                'name' => $nama,
                'phone' => $phone,
                'signed_up_country' => 'ID'
            ]);
            
            $registerResponse = makeRequest(
                '/v5/customers',
                null,
                $registerData
            );
            
            if (empty($registerResponse)) {
                echo color("red", "[-] Gagal menghubungi server Gojek\n");
                echo color("yellow", "[*] Coba lagi dengan koneksi yang lebih baik\n");
                continue;
            }
            
            $otpToken = extractValue($registerResponse, '"otp_token":"', '"');
            
            if (empty($otpToken)) {
                $error = extractValue($registerResponse, '"message":"', '"');
                if (strpos($registerResponse, 'already')) {
                    echo color("red", "[-] Nomor sudah terdaftar atau error: " . $error . "\n");
                } else {
                    echo color("red", "[-] Registrasi gagal: " . $error . "\n");
                }
                continue;
            }
            
            echo color("green", "[+] OTP Token diterima!\n");
            echo color("green", "[+] Kode verifikasi sudah dikirim ke nomor Anda\n");
            
            // Step 2: OTP verification
            echo color("blue", "\n[STEP 2] Verifikasi OTP...\n");
            echo color("nevy", "► Masukkan kode OTP (6 digit): ");
            $otp = trim(fgets(STDIN));
            
            if (empty($otp) || !is_numeric($otp)) {
                echo color("red", "[-] OTP harus berupa angka!\n");
                continue;
            }
            
            $verifyData = json_encode([
                'client_name' => 'gojek:cons:android',
                'data' => [
                    'otp' => $otp,
                    'otp_token' => $otpToken
                ],
                'client_secret' => '83415d06-ec4e-11e6-a41b-6c40088ab51e'
            ]);
            
            $verifyResponse = makeRequest(
                '/v5/customers/phone/verify',
                null,
                $verifyData
            );
            
            if (strpos($verifyResponse, '"access_token"') === false) {
                echo color("red", "[-] OTP tidak valid atau expired!\n");
                continue;
            }
            
            $accessToken = extractValue($verifyResponse, '"access_token":"', '"');
            $userId = extractValue($verifyResponse, '"resource_owner_id":', ',');
            
            if (empty($accessToken)) {
                echo color("red", "[-] Gagal mendapatkan access token\n");
                continue;
            }
            
            echo color("green", "[+] Verifikasi berhasil!\n");
            echo color("green", "[+] Access Token: " . substr($accessToken, 0, 20) . "...\n");
            
            // Step 3: Claim vouchers
            echo color("blue", "\n[STEP 3] Claim Voucher...\n");
            echo color("nevy", "► Ingin claim voucher? (y/n): ");
            $claimChoice = strtolower(trim(fgets(STDIN)));
            
            if ($claimChoice == 'y' || $claimChoice == 'yes') {
                claimVouchers($accessToken, $userId);
            }
            
            // Step 4: Summary
            showSummary($phone, $email, $nama, $accessToken, $userId);
            
            // Save to file
            saveRegistration([
                'phone' => $phone,
                'email' => $email,
                'name' => $nama,
                'token' => $accessToken,
                'user_id' => $userId,
                'timestamp' => date('Y-m-d H:i:s')
            ]);
            
            echo color("green", "\n[+] Registrasi selesai! Data disimpan ke registration_log.txt\n");
            
            // Ask to continue
            echo color("nevy", "\n► Lanjut registrasi nomor lain? (y/n): ");
            $continue = strtolower(trim(fgets(STDIN)));
            
            if ($continue != 'y' && $continue != 'yes') {
                echo color("cyan", "\n[*] Terima kasih telah menggunakan script ini!\n");
                break;
            }
            
            $attempts = 0;
            
        } catch (Exception $e) {
            echo color("red", "[-] Error: " . $e->getMessage() . "\n");
        }
    }
    
    if ($attempts >= $max_attempts) {
        echo color("red", "\n[-] Batas attempt tercapai. Program berhenti.\n");
    }
}

/**
 * Claim vouchers dari Gojek
 */
function claimVouchers($token, $userId) {
    $vouchers = [
        'GOFOOD2024DEC' => 'GoFood Discount',
        'GORIDE2024DEC' => 'GoRide Discount',
        'GOPAY2024' => 'GoPay Cashback',
        'FRESHFOOD2024' => 'Fresh Food Promo',
        'GOKONSUL2024' => 'GoKonsultasi Promo'
    ];
    
    echo color("yellow", "\n[*] Attempting to claim vouchers...\n");
    
    $successCount = 0;
    $failureCount = 0;
    
    foreach ($vouchers as $code => $name) {
        echo color("nevy", "  → " . $name . " (" . $code . ")...");
        
        $claimData = json_encode([
            'promo_code' => $code
        ]);
        
        $response = makeRequest(
            '/go-promotions/v1/promotions/enrollments',
            $token,
            $claimData
        );
        
        if (strpos($response, 'sudah bisa dipakai') || strpos($response, 'success') || strpos($response, '200')) {
            echo color("green", " [✓]\n");
            $successCount++;
        } else {
            echo color("red", " [✗]\n");
            $failureCount++;
        }
        
        sleep(1); // Delay untuk menghindari rate limiting
    }
    
    echo color("yellow", "\n[*] Claim Summary: " . $successCount . " berhasil, " . $failureCount . " gagal\n");
    
    // Check voucher wallet
    echo color("blue", "\n[*] Checking wallet vouchers...\n");
    $walletResponse = makeRequest(
        '/gopoints/v3/wallet/vouchers?limit=10&page=1',
        $token
    );
    
    $totalVouchers = extractValue($walletResponse, '"total_vouchers":', ',');
    echo color("green", "[+] Total voucher di wallet: " . $totalVouchers . "\n");
}

/**
 * Display summary
 */
function showSummary($phone, $email, $nama, $token, $userId) {
    echo color("cyan", "\n╔════════════════════════════════════════╗\n");
    echo color("cyan", "║          REGISTRATION SUMMARY          ║\n");
    echo color("cyan", "╠════════════════════════════════════════╣\n");
    echo color("green", "║ Nama: " . str_pad($nama, 31) . "║\n");
    echo color("green", "║ Email: " . str_pad($email, 30) . "║\n");
    echo color("green", "║ Nomor: " . str_pad($phone, 29) . "║\n");
    echo color("green", "║ User ID: " . str_pad($userId, 28) . "║\n");
    echo color("green", "║ Token: " . str_pad(substr($token, 0, 25) . "...", 29) . "║\n");
    echo color("cyan", "╚════════════════════════════════════════╝\n");
}

/**
 * Save registration to file
 */
function saveRegistration($data) {
    $logFile = 'registration_log.txt';
    $content = "═══════════════════════════════════════\n";
    $content .= "Nomor: " . $data['phone'] . "\n";
    $content .= "Email: " . $data['email'] . "\n";
    $content .= "Nama: " . $data['name'] . "\n";
    $content .= "Token: " . $data['token'] . "\n";
    $content .= "User ID: " . $data['user_id'] . "\n";
    $content .= "Waktu: " . $data['timestamp'] . "\n";
    $content .= "═══════════════════════════════════════\n\n";
    
    file_put_contents($logFile, $content, FILE_APPEND);
}

// Run main function
main();
?>