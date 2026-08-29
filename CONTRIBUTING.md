# Contributing Guidelines

Terima kasih tertarik berkontribusi pada proyek Gojek Auto Register! Berikut adalah panduan untuk kontribusi.

## 📋 Code of Conduct

- Hormati dan hargai semua kontributor
- Jangan melakukan spam atau harassment
- Gunakan bahasa yang sopan dan profesional
- Fokus pada peningkatan kualitas kode

## 🚀 Cara Berkontribusi

### 1. Fork Repository

```bash
# Clone fork Anda
git clone https://github.com/YOUR_USERNAME/gojek-auto-register-updated.git
cd gojek-auto-register-updated
```

### 2. Buat Branch Baru

```bash
# Buat branch untuk fitur Anda
git checkout -b feature/nama-fitur

# Atau untuk bug fix
git checkout -b bugfix/nama-bug
```

### 3. Buat Perubahan

- Edit file yang diperlukan
- Tambahkan komentar untuk kode yang kompleks
- Follow coding standards yang ada

### 4. Test Perubahan

```bash
# Test script di Termux
php gojek.php

# Check untuk syntax errors
php -l gojek.php
php -l func.php
```

### 5. Commit Changes

```bash
# Commit dengan pesan yang deskriptif
git add .
git commit -m "Tambah fitur X untuk Y"

# Contoh commit messages:
# "Tambah validasi input yang lebih baik"
# "Fix bug OTP verification"
# "Update dokumentasi instalasi"
```

### 6. Push ke GitHub

```bash
git push origin feature/nama-fitur
```

### 7. Buat Pull Request

1. Buka GitHub repository Anda
2. Klik "New Pull Request"
3. Select branch Anda
4. Tambahkan deskripsi lengkap
5. Submit PR

## 📝 PR Description Template

```markdown
## Deskripsi
Jelaskan perubahan yang Anda buat

## Type of Change
- [ ] Bug fix
- [ ] New feature
- [ ] Documentation update
- [ ] Performance improvement

## Testing
Jelaskan bagaimana Anda test perubahan ini

## Checklist
- [ ] Kode sudah di-test
- [ ] Dokumentasi sudah di-update
- [ ] Commit messages sudah deskriptif
```

## 🎯 Areas untuk Kontribusi

### Code
- ✨ New features
- 🐛 Bug fixes
- 🚀 Performance improvements
- 🔒 Security enhancements

### Documentation
- 📖 README improvements
- 🔍 Better examples
- 🎓 Tutorials
- 🆘 Troubleshooting guides

### Testing
- 🧪 Test cases
- 📊 Edge cases
- ✅ Validation improvements

## 💻 Coding Standards

### PHP Style

```php
// Good
function validatePhone($phone) {
    if (empty($phone)) {
        return false;
    }
    return true;
}

// Bad
function validatephone($phone){
if(empty($phone)){
return false;}
return true;}
```

### Comments

```php
/**
 * Brief description
 * 
 * Longer description if needed
 * 
 * @param string $param Description
 * @return bool Description
 */
function example($param) {
    // Implementation
}
```

### Variable Naming

```php
// Good
$phoneNumber = '628123456789';
$accessToken = 'token_value';
$isValid = true;

// Bad
$pn = '628123456789';
$tok = 'token_value';
$v = true;
```

## 🔒 Security Guidelines

- Jangan commit credentials/API keys
- Sanitize user input
- Validate data sebelum processing
- Use HTTPS untuk API calls
- Follow OWASP guidelines

## 📋 Commit Message Guidelines

```
<type>: <subject>

<body>

<footer>
```

### Types
- `feat:` Fitur baru
- `fix:` Bug fix
- `docs:` Dokumentasi
- `style:` Formatting
- `refactor:` Code refactoring
- `perf:` Performance improvements
- `test:` Testing

### Examples

```
feat: Add voucher claim retry mechanism

Implement automatic retry for failed voucher claims
with exponential backoff strategy

Closes #123
```

## ❓ Questions?

Jika punya pertanyaan:

1. Baca dokumentasi yang ada
2. Check issues yang sudah ada
3. Buat issue baru dengan label `question`
4. Beri konteks yang jelas dan lengkap

## 🙏 Thank You!

Terima kasih sudah berkontribusi! Kontribusi Anda membantu membuat proyek ini lebih baik.

---

**Happy Contributing!** 🎉
