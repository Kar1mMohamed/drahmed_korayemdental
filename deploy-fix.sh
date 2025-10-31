#!/bin/bash

# Laravel Deployment Fix Script
# This script addresses common deployment issues

echo "🚀 Starting Laravel deployment fixes..."

# 1. Clear all caches
echo "📝 Clearing Laravel caches..."
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# 2. Build Vite assets (if Node.js is available)
if command -v npm &> /dev/null; then
    echo "📦 Installing Node.js dependencies..."
    npm install --production
    
    echo "🏗️ Building production assets..."
    npm run build
    
    echo "✅ Vite assets built successfully"
else
    echo "⚠️ Node.js not found. Please build assets manually with 'npm run build'"
fi

# 3. Optimize Laravel for production
echo "⚡ Optimizing Laravel for production..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

# 4. Set proper permissions
echo "🔐 Setting proper permissions..."
chmod -R 755 storage/
chmod -R 755 bootstrap/cache/

# 5. Run migrations safely
echo "🗄️ Running database migrations..."
php artisan migrate --force

echo "✅ Deployment fixes completed!"
echo ""
echo "📋 Manual checks needed:"
echo "1. Verify .env file has correct database credentials"
echo "2. Check that public/build/manifest.json exists"
echo "3. Ensure all Livewire components have root HTML elements"
echo "4. Test the application in browser"