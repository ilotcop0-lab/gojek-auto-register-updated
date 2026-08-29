#!/bin/bash
# Quick Start Script untuk Termux

echo "╔════════════════════════════════════════╗"
echo "║  Gojek Auto Register - Quick Setup    ║"
echo "║        For Termux Android             ║"
echo "╚════════════════════════════════════════╝"
echo ""

# Check if running on Termux
if [ ! -d "$PREFIX" ]; then
    echo "❌ Anda tidak berada di Termux!"
    echo "Silakan buka aplikasi Termux terlebih dahulu."
    exit 1
fi

echo "✅ Terdeteksi Termux"
echo ""

# Step 1: Update packages
echo "📦 Step 1: Update packages..."
pkg update -y
pkg upgrade -y
echo "✅ Packages updated"
echo ""

# Step 2: Install dependencies
echo "📦 Step 2: Install dependencies..."
pkg install -y php curl git
echo "✅ Dependencies installed"
echo ""

# Step 3: Verify installation
echo "🔍 Step 3: Verify installation..."
echo -n "  PHP version: "
php --version | head -n 1
echo -n "  CURL version: "
curl --version | head -n 1
echo -n "  GIT version: "
git --version
echo "✅ All dependencies verified"
echo ""

# Step 4: Clone repository
echo "📥 Step 4: Clone repository..."
if [ -d "gojek-auto-register-updated" ]; then
    echo "  Folder already exists, pulling latest version..."
    cd gojek-auto-register-updated
    git pull origin main
else
    git clone https://github.com/ilotcop0-lab/gojek-auto-register-updated
    cd gojek-auto-register-updated
fi
echo "✅ Repository ready"
echo ""

# Step 5: List files
echo "📂 Files in repository:"
ls -lh *.php *.md 2>/dev/null | awk '{print "  " $9 " (" $5 ")"}'
echo ""

# Step 6: Ready to run
echo "╔════════════════════════════════════════╗"
echo "║       Setup Complete! 🎉              ║"
echo "╚════════════════════════════════════════╝"
echo ""
echo "To start the script, run:"
echo "  php gojek.php"
echo ""
echo "For help, read:"
echo "  cat README.md"
echo "  cat INSTALL.md"
echo ""
