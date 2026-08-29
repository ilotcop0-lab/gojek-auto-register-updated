# Panduan Instalasi Lengkap untuk Termux Android

## 📱 Instalasi Termux

### Option 1: Google Play Store (Recommended)
1. Buka Google Play Store
2. Cari "Termux"
3. Klik "Install"
4. Tunggu selesai, buka aplikasi

### Option 2: F-Droid (Alternative)
1. Install F-Droid dari https://f-droid.org
2. Buka F-Droid
3. Cari "Termux"
4. Klik "Install"

## 🔧 Setup Termux

### Step 1: Update Packages
Setelah membuka Termux, jalankan:

```bash
pkg update
```

Tunggu selesai, akan terlihat:
```
Reading package lists... Done
Building dependency tree... Done
```

### Step 2: Upgrade Packages
```bash
pkg upgrade
```

Pilih `y` jika ditanya, tunggu selesai.

### Step 3: Install PHP dan CURL
```bash
pkg install php curl git
```

Pilih `y` untuk confirm installation.

### Step 4: Verifikasi Instalasi
```bash
php --version
curl --version
git --version
```

Jika semua menampilkan versi, berarti instalasi berhasil! ✅

## 📥 Clone Repository

### Opsi 1: Via Git Clone (Recommended)
```bash
git clone https://github.com/ilotcop0-lab/gojek-auto-register-updated
cd gojek-auto-register-updated
```

### Opsi 2: Manual Download
Jika git tidak bekerja, download file manual:

```bash
# Create directory
mkdir gojek-auto-register
cd gojek-auto-register

# Download files
curl -O https://raw.githubusercontent.com/ilotcop0-lab/gojek-auto-register-updated/main/gojek.php
curl -O https://raw.githubusercontent.com/ilotcop0-lab/gojek-auto-register-updated/main/func.php
curl -O https://raw.githubusercontent.com/ilotcop0-lab/gojek-auto-register-updated/main/README.md
```

## ▶️ Menjalankan Script

### First Run
```bash
php gojek.php
```

### Jika Error "Could not open input file"
```bash
# Cek lokasi sekarang
pwd

# Lihat file di folder
ls -la

# Jalankan dengan path yang benar
php ./gojek.php
```

### Screen akan menampilkan:
```
[]════════════════════════════════════════[]
[]   Gojek Auto Register & Claim Voucher   []
[]         Updated Version 2025            []
[]════════════════════════════════════════[]

[*] Started: [29-08-2025 13:47:00]
[*] Timezone: Asia/Jakarta

[INFO] Format nomor:
  - Indonesia (62): 628123456789
  - Format Alternatif: +628123456789

[Attempt 1/3]
► Masukkan nomor (62XXXXXXXXXX): _
```

Sekarang Anda bisa mulai menggunakan script! 🎉

## 📝 File-File Important

Setelah menjalankan script, akan ada file baru:

### `registration_log.txt`
Berisi data semua registrasi yang berhasil:
```
═══════════════════════════════════════
Nomor: 628123456789
Email: adipratama5632@gmail.com
Nama: Adi Pratama
Token: eyJhbGciOiJIUzI1NiIs...
User ID: 123456
Waktu: 2025-08-29 13:47:15
═══════════════════════════════════════
```

Untuk membaca file:
```bash
cat registration_log.txt
```

### `debug.log`
Berisi log error dan debugging. Gunakan jika ada error:
```bash
cat debug.log
```

## 🐛 Common Issues & Solutions

### Issue 1: "command not found: pkg"
**Solusi:** Anda mungkin tidak berada di Termux
- Buka Termux application
- Jangan buka Terminal lain

### Issue 2: "curl: command not found"
**Solusi:** CURL belum terinstall
```bash
pkg install curl
```

### Issue 3: "PHP Parse Error"
**Solusi:** PHP version tidak kompatibel
```bash
php --version
pkg install php   # Update PHP
```

### Issue 4: Nomor "sudah terdaftar"
**Solusi:**
- Gunakan nomor berbeda
- Tunggu 24 jam
- Cek apakah nomor sudah terdaftar di Gojek

### Issue 5: Timeout/Connection Error
**Solusi:**
- Cek koneksi internet: `curl -I https://google.com`
- Coba dengan WiFi/data yang lain
- Coba proxy/VPN
- Restart Termux

## 📋 Checklist Sebelum Jalankan

- [ ] Termux sudah terinstall dan dibuka
- [ ] `php --version` menampilkan versi
- [ ] `curl --version` menampilkan versi
- [ ] Repository sudah di-clone atau files sudah di-download
- [ ] Anda sudah di folder `gojek-auto-register-updated`
- [ ] Koneksi internet berfungsi baik

## 🎯 Next Steps

Setelah instalasi selesai:

1. **Baca README.md** untuk dokumentasi lengkap
2. **Jalankan script:** `php gojek.php`
3. **Input nomor telepon** sesuai format
4. **Tunggu OTP** dan verifikasi
5. **Claim voucher** (optional)
6. **Check hasil** di `registration_log.txt`

## 💻 Useful Termux Commands

```bash
# Navigation
pwd                    # Print working directory
ls                     # List files
ls -la                 # List dengan detail
cd folder_name         # Change directory
cd ..                  # Go up one level
mkdir folder_name      # Create folder
rm file.txt           # Delete file
rm -rf folder_name    # Delete folder

# File operations
cat file.txt          # Display file content
nano file.txt         # Edit file
cp file.txt copy.txt  # Copy file
mv old.txt new.txt    # Rename file

# System
clear                 # Clear screen
exit                  # Exit Termux
top                   # System resources
df -h                 # Disk usage

# Git operations
git clone URL         # Clone repository
git pull              # Update repository
git status            # Check changes
```

## 🔐 Security Tips

1. **Jangan share access token** Anda
2. **Delete registration_log.txt** jika ada data sensitif
3. **Gunakan password yang kuat** untuk akun Gojek
4. **Aktifkan 2FA** di Gojek untuk keamanan extra
5. **Jangan jalankan script yang tidak dipercaya**

## 📞 Get Help

Jika masih ada masalah:

1. Check error message dengan teliti
2. Baca `debug.log` untuk details
3. Search di Google: `"error message" termux`
4. Buat issue di GitHub dengan screenshot error

## ✅ Instalasi Selesai!

Jika semua langkah sudah selesai tanpa error, berarti instalasi **BERHASIL**! 🎉

Sekarang Anda bisa mulai:
```bash
php gojek.php
```

Selamat mencoba! Happy coding! 🚀

---

**Pertanyaan atau masalah? Baca README.md atau buat issue di GitHub!**

**Last Updated:** 29 Agustus 2025
