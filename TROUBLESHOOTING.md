# Troubleshooting Guide

Panduan lengkap untuk mengatasi semua error yang mungkin terjadi saat menggunakan script Gojek Auto Register.

## 🆘 Common Errors & Solutions

### 1. CURL/PHP Errors

#### Error: "curl: command not found"
```
-bash: curl: command not found
```

**Penyebab:** CURL belum terinstall

**Solusi:**
```bash
pkg update
pkg install curl
```

**Verifikasi:**
```bash
curl --version
```

---

#### Error: "PHP Parse Error"
```
Parse error: syntax error, unexpected '...'
```

**Penyebab:** 
- PHP version terlalu lama
- Syntax error dalam script

**Solusi:**
```bash
# Update PHP
pkg update
pkg install php

# Check versi
php --version  # Harus >= 5.4.0
```

---

### 2. File & Directory Errors

#### Error: "Could not open input file: gojek.php"
```
Could not open input file: gojek.php
```

**Penyebab:** 
- File tidak ditemukan
- Berada di folder yang salah

**Solusi:**
```bash
# Cek lokasi sekarang
pwd

# List file di folder saat ini
ls -la

# Jika ada gojek.php, jalankan dengan ./
php ./gojek.php

# Jika belum ada, clone repository
git clone https://github.com/ilotcop0-lab/gojek-auto-register-updated
cd gojek-auto-register-updated
php gojek.php
```

---

### 3. Network Errors

#### Error: "Gagal menghubungi server Gojek"
```
[-] Gagal menghubungi server Gojek
[-] Coba lagi dengan koneksi yang lebih baik
```

**Penyebab:** 
- Koneksi internet tidak stabil
- API Gojek sedang down
- Firewall/proxy memblokir

**Solusi:**
```bash
# Test koneksi
curl -I https://google.com

# Jika berhasil, coba dengan API Gojek
curl -I https://api.gojekapi.com

# Jika masih fail, coba:
# 1. Switch WiFi/data
# 2. Gunakan VPN
# 3. Restart Termux
```

---

#### Error: "Operation timed out"
```
curl: (28) Operation timed out after ...
```

**Penyebab:** 
- Koneksi lambat
- Server Gojek timeout
- Request terlalu banyak

**Solusi:**
```bash
# Tunggu beberapa menit
sleep 300

# Coba lagi dengan koneksi berbeda
# Gunakan WiFi jika sebelumnya data cellular
```

---

### 4. Registration Errors

#### Error: "Nomor sudah terdaftar"
```
[-] Nomor sudah terdaftar atau error: Phone number already registered
```

**Penyebab:** 
- Nomor sudah didaftarkan sebelumnya
- Nomor tidak valid untuk Indonesia

**Solusi:**
```bash
# Gunakan nomor berbeda
# Format harus benar: 62XXXXXXXXXX
# Contoh: 628123456789

# Atau tunggu 24-48 jam sebelum registrasi ulang
```

---

#### Error: "OTP tidak valid atau expired"
```
[-] OTP tidak valid atau expired!
```

**Penyebab:** 
- OTP salah
- OTP sudah expired (valid 15 menit)
- Input format salah

**Solusi:**
```bash
# OTP harus 6 digit angka
# Contoh: 123456

# Jika expired, restart script dan daftar ulang
# Terminalkan dengan Ctrl+C
# Jalankan: php gojek.php
```

---

### 5. Termux-Specific Errors

#### Error: "command not found: pkg"
```
-bash: pkg: command not found
```

**Penyebab:** Tidak berada di Termux

**Solusi:**
- Buka aplikasi Termux (bukan terminal lain)
- Pastikan sudah membuka Termux dari app drawer

---

## 🔍 Debug Tips

### 1. Check Logs
```bash
# Lihat debug.log
cat debug.log

# Lihat X baris terakhir
tail -50 debug.log

# Cari error tertentu
grep -i "error" debug.log
```

### 2. Manual API Testing
```bash
# Test koneksi ke API
curl -I https://api.gojekapi.com/v5/customers
```

### 3. Check Network
```bash
# Cek koneksi internet
ping -c 5 google.com

# Cek DNS
nslookup api.gojekapi.com
```

---

## 📋 Checklist Debugging

Sebelum ask for help, check:

- [ ] PHP version >= 5.4.0? (`php --version`)
- [ ] CURL terinstall? (`curl --version`)
- [ ] Koneksi internet OK? (`curl -I google.com`)
- [ ] File gojek.php dan func.php ada? (`ls -la`)
- [ ] Sudah di folder yang benar? (`pwd`)
- [ ] Check debug.log ada error? (`tail debug.log`)
- [ ] Nomor format benar? (62XXXXXXXXXX)

---

**Last Updated:** 29 Agustus 2025
