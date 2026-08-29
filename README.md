# Gojek Auto Register & Claim Voucher - Updated 2025

Script PHP untuk auto register akun Gojek dan claim voucher secara otomatis. **Versi terbaru yang kompatibel dengan Termux Android**.

## ⚠️ Disclaimer

- Script ini **HANYA untuk tujuan edukasi dan testing**
- Penggunaan script dapat melanggar Terms of Service Gojek
- **Gunakan dengan risiko Anda sendiri**
- Penulis tidak bertanggung jawab atas penyalahgunaan

## ✨ Fitur

- ✅ Auto registrasi akun Gojek
- ✅ Verifikasi OTP otomatis
- ✅ Claim multiple vouchers
- ✅ Simpan data registrasi ke file
- ✅ Error handling yang lebih baik
- ✅ Validasi nomor telepon
- ✅ Kompatibel dengan Termux Android
- ✅ Display berwarna untuk terminal
- ✅ Retry mechanism

## 📋 Requirements

- PHP >= 5.4.0
- CURL extension
- Koneksi internet stabil
- Termux Android (untuk pengguna mobile)

## 🚀 Instalasi

### Step 1: Install Termux Android

Download Termux dari [Google Play Store](https://play.google.com/store/apps/details?id=com.termux) atau [F-Droid](https://f-droid.org/en/packages/com.termux/)

### Step 2: Setup di Termux

```bash
# Update packages
pkg update && pkg upgrade

# Install dependencies
pkg install php curl git

# Verify installations
php --version
curl --version
```

### Step 3: Clone Repository

```bash
# Clone repository
git clone https://github.com/ilotcop0-lab/gojek-auto-register-updated

# Masuk ke folder
cd gojek-auto-register-updated

# Lihat file yang tersedia
ls -la
```

## 📖 Cara Penggunaan

### Basic Usage

```bash
php gojek.php
```

### Langkah-Langkah Penggunaan

1. **Jalankan script:**
   ```bash
   php gojek.php
   ```

2. **Input nomor telepon:**
   - Format: `62XXXXXXXXXX` (Indonesia)
   - Contoh: `628123456789`
   - Script akan otomatis memformat nomor

3. **Tunggu OTP:**
   - Kode OTP akan dikirim ke nomor Anda
   - Check SMS atau notifikasi Gojek

4. **Masukkan OTP:**
   - Input 6 digit kode yang diterima
   - Proses verifikasi dilakukan otomatis

5. **Claim Voucher:**
   - Pilih `y` untuk claim atau `n` untuk skip
   - Script akan claim beberapa voucher secara otomatis

6. **Lanjut/Selesai:**
   - Pilih `y` untuk registrasi nomor lain
   - Pilih `n` untuk selesai

### Output Files

Script akan generate beberapa file:

- **`registration_log.txt`** - Log semua registrasi yang berhasil
- **`debug.log`** - Log error dan debug info

## 📝 Contoh Input/Output

```
[STEP 1] Registering account...
► Masukkan nomor (62XXXXXXXXXX): 628123456789
[+] Nomor valid: 628123456789
[*] Nama: Adi Pratama
[*] Email: adipratama5632@gmail.com
[+] OTP Token diterima!
[+] Kode verifikasi sudah dikirim ke nomor Anda

[STEP 2] Verifikasi OTP...
► Masukkan kode OTP (6 digit): 123456
[+] Verifikasi berhasil!
[+] Access Token: eyJhbGciOiJIUzI1NiIs...

[STEP 3] Claim Voucher...
► Ingin claim voucher? (y/n): y

[*] Attempting to claim vouchers...
  → GoFood Discount (GOFOOD2024DEC)... [✓]
  → GoRide Discount (GORIDE2024DEC)... [✓]
  → GoPay Cashback (GOPAY2024)... [✗]
```

## 🔧 Troubleshooting

### Problem: "Could not open input file"

**Solusi:**
```bash
# Pastikan Anda di folder yang benar
pwd

# Lihat file yang ada
ls -la

# Coba jalankan dengan path lengkap
php ./gojek.php
```

### Problem: "Nomor sudah terdaftar"

**Solusi:**
- Gunakan nomor telepon yang berbeda
- Tunggu beberapa jam sebelum registrasi lagi
- Cek apakah nomor sudah terdaftar di Gojek

### Problem: "Gagal menghubungi server"

**Solusi:**
- Cek koneksi internet
- Coba matikan WiFi dan gunakan data cellular
- Coba gunakan VPN atau proxy
- Tunggu beberapa saat dan coba lagi

### Problem: "PHP/CURL not found"

**Solusi:**
```bash
# Reinstall dependencies
pkg remove php curl
pkg update
pkg install php curl

# Verify
php -v
curl -V
```

### Problem: "timeout atau response lambat"

**Solusi:**
- Gunakan koneksi internet yang lebih cepat
- Periksa signal/WiFi strength
- Tutup aplikasi lain yang menggunakan bandwidth

## 📊 Struktur File

```
gojek-auto-register-updated/
├── gojek.php              # Main script
├── func.php               # Helper functions
├── README.md              # Dokumentasi
├── INSTALL.md             # Installation guide
├── registration_log.txt   # Output log (generated)
└── debug.log             # Debug log (generated)
```

## 🔑 API Endpoints

Script menggunakan endpoint resmi Gojek:

- `POST /v5/customers` - Registrasi
- `POST /v5/customers/phone/verify` - Verifikasi OTP
- `POST /go-promotions/v1/promotions/enrollments` - Claim voucher
- `GET /gopoints/v3/wallet/vouchers` - Check wallet

## 📚 Dokumentasi Lengkap

### Fungsi Utama di `func.php`

#### `makeRequest($endpoint, $token, $data)`
Membuat HTTP request ke Gojek API

#### `validatePhone($phone)`
Validasi format nomor telepon

#### `sanitizePhone($phone)`
Bersihkan format nomor telepon

#### `generateName()`
Generate random nama Indonesia

#### `extractValue($str, $start, $end)`
Extract value dari string

#### `color($colorName, $text)`
Output berwarna untuk terminal

## 💡 Tips & Tricks

1. **Gunakan nomor virtual:**
   - Coba aplikasi seperti TextNow atau OpenPhone
   - Beli nomor virtual dari provider

2. **Bypass rate limiting:**
   - Gunakan sleep/delay antara request
   - Ganti User-Agent secara berkala
   - Gunakan proxy/VPN

3. **Maksimalkan voucher:**
   - Claim di awal untuk promo terbaru
   - Pantau promo code yang baru
   - Check expiry date voucher

4. **Error handling:**
   - Cek debug.log untuk error details
   - Simak pesan error dari API
   - Retry jika timeout

## 🤝 Kontribusi

Jika Anda punya ide atau menemukan bug:
1. Fork repository
2. Buat branch baru (`git checkout -b fitur-baru`)
3. Commit changes (`git commit -m 'Tambah fitur X'`)
4. Push ke branch (`git push origin fitur-baru`)
5. Buat Pull Request

## 📄 Lisensi

Script ini tersedia untuk tujuan edukasi. Gunakan dengan bijak dan bertanggung jawab.

## 📞 Support

Jika ada pertanyaan atau masalah:

1. **Check dokumentasi** di atas
2. **Check debug.log** untuk error details
3. **Buat issue** di GitHub repository
4. **Search** di Google atau Stack Overflow

## 🔄 Update Log

### Version 2.0 (2025)
- ✨ Rewrite dengan structure yang lebih baik
- ✨ Better error handling
- ✨ Improved UI/UX
- ✨ Kompatibel dengan Termux Android
- ✨ Dokumentasi lengkap

### Version 1.0 (2020)
- Initial release

## ⚡ Quick Start

```bash
# Setup lengkap (copy-paste)
pkg update && pkg upgrade
pkg install php curl git
git clone https://github.com/ilotcop0-lab/gojek-auto-register-updated
cd gojek-auto-register-updated
php gojek.php
```

---

**Made with ❤️ for educational purposes**

**Last Updated:** 29 Agustus 2025
