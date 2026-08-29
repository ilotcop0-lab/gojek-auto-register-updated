<?php
/**
 * Helper Functions for Gojek Auto Register
 * Updated 2025
 */

// Base API Configuration
define('GOJEK_API_BASE', 'https://api.gojekapi.com');
define('GOJEK_API_TIMEOUT', 30);

/**
 * Make HTTP Request to Gojek API
 */
function makeRequest($endpoint, $token = null, $data = null, $method = 'POST') {
    try {
        $headers = getDefaultHeaders();
        
        if ($token) {
            $headers[] = 'Authorization: Bearer ' . $token;
        }
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, GOJEK_API_BASE . $endpoint);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_TIMEOUT, GOJEK_API_TIMEOUT);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, GOJEK_API_TIMEOUT);
        
        if ($data && $method === 'POST') {
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        }
        
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $error = curl_error($ch);
        
        curl_close($ch);
        
        if ($error) {
            echo color("red", "\n[-] CURL Error: " . $error . "\n");
            return false;
        }
        
        return $response;
        
    } catch (Exception $e) {
        echo color("red", "[-] Request Error: " . $e->getMessage() . "\n");
        return false;
    }
}

/**
 * Get default headers for API requests
 */
function getDefaultHeaders() {
    $headers = [
        'Host: api.gojekapi.com',
        'User-Agent: okhttp/3.12.12',
        'Accept: application/json',
        'Accept-Language: en-ID',
        'Content-Type: application/json; charset=UTF-8',
        'X-AppVersion: 3.48.2',
        'X-UniqueId: ' . time() . '57' . mt_rand(1000, 9999),
        'X-User-Locale: en_ID',
        'X-Location: -8.729074, 115.182881',
        'Connection: keep-alive'
    ];
    
    return $headers;
}

/**
 * Validate phone number format
 */
function validatePhone($phone) {
    // Remove + if exists
    $phone = str_replace('+', '', $phone);
    
    // Must start with 62
    if (strpos($phone, '62') !== 0) {
        return false;
    }
    
    // Must be 10-13 digits after 62
    $digits = strlen($phone);
    if ($digits < 11 || $digits > 13) {
        return false;
    }
    
    // Must be numeric
    if (!is_numeric($phone)) {
        return false;
    }
    
    return true;
}

/**
 * Sanitize phone number
 */
function sanitizePhone($phone) {
    // Remove spaces and common separators
    $phone = str_replace([' ', '-', '(', ')', '+'], '', $phone);
    
    // If starts with 0, replace with 62
    if (strpos($phone, '0') === 0) {
        $phone = '62' . substr($phone, 1);
    }
    
    return $phone;
}

/**
 * Sanitize string (remove special characters)
 */
function sanitizeString($str) {
    $str = preg_replace('/[^a-zA-Z0-9]/', '', $str);
    return strtolower($str);
}

/**
 * Generate random name
 */
function generateName() {
    $names = [
        'Adi Pratama', 'Budi Santoso', 'Citra Dewi', 'Dian Kusuma',
        'Eka Putri', 'Fajar Rahman', 'Gita Sari', 'Hendra Wijaya',
        'Indra Kusuma', 'Joko Widodo', 'Karina Sasha', 'Lestari Putri',
        'Megan Azalea', 'Nadia Purwanto', 'Oscar Lawalata', 'Priya Ayunda',
        'Qori Hasibuan', 'Rifa Marsela', 'Siti Nurhaliza', 'Tanya Marquez',
        'Utari Kusuma', 'Vino G Bastian', 'Widi Widiana', 'Xena Kusnadi',
        'Yuliana Putri', 'Zaskia Mecca'
    ];
    
    return $names[array_rand($names)];
}

/**
 * Extract value from string
 */
function extractValue($str, $start, $end) {
    $startPos = strpos($str, $start);
    if ($startPos === false) {
        return '';
    }
    
    $startPos += strlen($start);
    $endPos = strpos($str, $end, $startPos);
    
    if ($endPos === false) {
        return '';
    }
    
    return substr($str, $startPos, $endPos - $startPos);
}

/**
 * Color output for terminal
 */
function color($colorName = 'default', $text = '') {
    $colors = [
        'default' => '0;39',
        'black' => '0;30',
        'dark_gray' => '1;30',
        'blue' => '0;34',
        'dark_blue' => '1;34',
        'light_blue' => '1;34',
        'green' => '0;32',
        'dark_green' => '1;32',
        'light_green' => '1;32',
        'cyan' => '0;36',
        'dark_cyan' => '1;36',
        'light_cyan' => '1;36',
        'red' => '0;31',
        'dark_red' => '1;31',
        'light_red' => '1;31',
        'purple' => '0;35',
        'dark_purple' => '1;35',
        'light_purple' => '1;35',
        'brown' => '0;33',
        'yellow' => '1;33',
        'light_gray' => '0;37',
        'white' => '1;37',
        'nevy' => '1;36'
    ];
    
    $colorCode = isset($colors[$colorName]) ? $colors[$colorName] : $colors['default'];
    return "\033[" . $colorCode . "m" . $text . "\033[0m";
}

?>