# Server Deployment - Quick Start Guide

## Current Issue
Getting "Please provide a valid cache path" error when running `composer install` on Hostinger server.

## Solution Overview
Your application now has built-in diagnostics to identify and fix the issue.

---

## 🚀 Quick Fix (30 seconds)

### Option 1: Browser Method (No SSH Required)

1. **Upload** `fix-storage-permissions.php` to your server root
2. **Visit** in browser: `https://drahmed.korayemdental.com/fix-storage-permissions.php`
3. **Run** composer install:
   ```bash
   composer install --no-dev --optimize-autoloader
   ```
4. **Delete** the fix script for security

### Option 2: SSH Method (Recommended)

```bash
cd /home/u781510023/domains/drahmed.korayemdental.com
php fix-storage-permissions.php
composer install --no-dev --optimize-autoloader
rm fix-storage-permissions.php
```

Done!

---

## 🔍 Diagnostic Tools Available

### 1. Debug Mode (Built into index.php)
Add `?debug=true` to any URL:
```
https://drahmed.korayemdental.com/?debug=true
```

Shows real-time bootstrap process with directory status checks.

### 2. Bootstrap Log File
View detailed logs at: `storage/logs/bootstrap-debug.log`

### 3. Complete Diagnostic Script
Upload and run `diagnose-server.php` for comprehensive server analysis.

---

## 📋 Files Included

### Core Application
- ✅ `public/index.php` - Enhanced with detailed logging
- ✅ `composer.json` - Updated for PHP 8.2+ compatibility (Pest v3)
- ✅ `.gitignore` - Properly configured for Laravel

### Diagnostic & Fix Tools
- 🔧 `fix-storage-permissions.php` - Automated directory/permission fixer
- 🔍 `diagnose-server.php` - Complete server diagnostic tool
- 📖 `SERVER-SETUP-GUIDE.md` - Complete deployment guide
- 📖 `DEBUGGING-GUIDE.md` - Step-by-step debugging instructions
- 📖 `README-SERVER-DEPLOYMENT.md` - This file

---

## 🎯 What Was Fixed

### 1. PHP Version Compatibility
- **Before:** Pest v4 required PHP 8.3+
- **After:** Pest v3 works with PHP 8.2+ (your server version)

### 2. Enhanced Error Tracking
- Added detailed logging to `public/index.php`
- Logs every bootstrap step
- Shows directory status (exists/writable)
- Captures full error stack traces

### 3. Storage Directory Management
- Automated creation of missing directories
- Proper permission setting (775)
- .gitignore files for all storage subdirectories

### 4. Comprehensive .gitignore
- Properly ignores vendor, node_modules, .env
- Keeps directory structure in Git
- Ignores deployment files and documentation

---

## 📊 Repository Status

### Properly Ignored (Not in Git):
- ✅ `vendor/` - Composer dependencies
- ✅ `node_modules/` - NPM packages
- ✅ `.env` - Environment configuration
- ✅ `composer.lock` - Lock file
- ✅ `package-lock.json` - NPM lock file
- ✅ `storage/logs/*.log` - Log files
- ✅ `storage/framework/views/*.php` - Compiled views
- ✅ Build artifacts and deployment files

### Tracked in Git:
- ✅ Application code (`app/`, `resources/`, etc.)
- ✅ Configuration files (`config/`)
- ✅ `.env.example` - Example environment
- ✅ `.gitignore` files - Directory structure
- ✅ `composer.json` - Dependency definitions
- ✅ `package.json` - Frontend dependencies

---

## 🚨 Common Issues & Solutions

### Issue: "Please provide a valid cache path"
**Cause:** Missing `storage/framework/views` directory or wrong permissions

**Solution:**
```bash
php fix-storage-permissions.php
```

### Issue: Composer install fails with PHP version error
**Cause:** Using old composer.lock with PHP 8.3 requirements

**Solution:**
```bash
rm composer.lock
composer install --no-dev --optimize-autoloader
```

### Issue: Can't write to log file
**Cause:** Missing or non-writable `storage/logs` directory

**Solution:**
```bash
mkdir -p storage/logs
chmod 775 storage/logs
```

### Issue: 500 Internal Server Error
**Cause:** Multiple possibilities

**Solution:**
```bash
# Enable debug mode temporarily
echo "APP_DEBUG=true" >> .env

# Visit site with ?debug=true
# Or check: storage/logs/bootstrap-debug.log

# Fix issues, then disable debug
echo "APP_DEBUG=false" >> .env
```

---

## 🔐 Security Checklist

Before going live:

- [ ] Delete diagnostic scripts:
  ```bash
  rm diagnose-server.php
  rm fix-storage-permissions.php
  ```

- [ ] Verify `.env` settings:
  ```bash
  APP_ENV=production
  APP_DEBUG=false
  ```

- [ ] Set proper file permissions:
  ```bash
  chmod -R 755 .
  chmod -R 775 storage bootstrap/cache
  ```

- [ ] Clear and cache configs:
  ```bash
  php artisan config:clear
  php artisan config:cache
  php artisan route:cache
  php artisan view:cache
  ```

---

## 📞 Getting Help

### 1. Check the Logs
```bash
# Bootstrap log (startup issues)
cat storage/logs/bootstrap-debug.log

# Application log (runtime errors)
tail -50 storage/logs/laravel.log
```

### 2. Run Diagnostics
```bash
php diagnose-server.php > diagnostic-report.txt
cat diagnostic-report.txt
```

### 3. Enable Debug Mode
Visit: `https://drahmed.korayemdental.com/?debug=true`

### 4. Review Documentation
- `SERVER-SETUP-GUIDE.md` - Complete deployment guide
- `DEBUGGING-GUIDE.md` - Detailed debugging steps

---

## 🎓 Understanding the Error

### What "Please provide a valid cache path" Means:
Laravel needs to compile Blade templates and store them in `storage/framework/views/`. If this directory:
- Doesn't exist
- Isn't writable
- Has wrong permissions

Laravel can't cache the views and throws this error.

### Where It Happens:
The error occurs during the Laravel bootstrap process, specifically when:
1. Composer runs `@php artisan package:discover`
2. Laravel tries to initialize the view compiler
3. The compiler checks for a valid cache directory
4. It fails to find or write to `storage/framework/views/`

### The Fix:
Create the directory with proper permissions:
```bash
mkdir -p storage/framework/views
chmod 775 storage/framework/views
echo "*" > storage/framework/views/.gitignore
echo "!.gitignore" >> storage/framework/views/.gitignore
```

Or use the automated script: `php fix-storage-permissions.php`

---

## ✅ Deployment Checklist

### Pre-Deployment (Local)
- [x] Fixed PHP version compatibility (Pest v3)
- [x] Added diagnostic logging to index.php
- [x] Created fix-storage-permissions.php
- [x] Created diagnose-server.php
- [x] Configured proper .gitignore
- [x] Tested logging locally
- [ ] Commit and push changes

### On Server
- [ ] Upload/pull latest code
- [ ] Upload fix-storage-permissions.php
- [ ] Run: `php fix-storage-permissions.php`
- [ ] Run: `composer install --no-dev --optimize-autoloader`
- [ ] Run: `php artisan migrate --force`
- [ ] Run: `php artisan config:cache`
- [ ] Run: `php artisan route:cache`
- [ ] Run: `php artisan view:cache`
- [ ] Delete: `fix-storage-permissions.php`
- [ ] Delete: `diagnose-server.php`
- [ ] Test the site!

---

## 📝 Quick Reference Commands

```bash
# Navigate to project
cd /home/u781510023/domains/drahmed.korayemdental.com

# Fix directories and permissions
php fix-storage-permissions.php

# Install dependencies
composer install --no-dev --optimize-autoloader

# Clear all caches
php artisan config:clear
php artisan cache:clear
php artisan view:clear

# Optimize for production
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan event:cache

# Check status
php artisan --version
cat storage/logs/bootstrap-debug.log

# View diagnostics
php diagnose-server.php

# Clean up
rm diagnose-server.php fix-storage-permissions.php
```

---

## 🎉 Success Indicators

After deployment, you should see:

✅ No errors when running `composer install`
✅ Website loads without 500 errors
✅ `bootstrap-debug.log` shows "Request handled successfully"
✅ `php artisan --version` shows Laravel Framework version
✅ All artisan commands work

---

## 📌 Important Notes

1. **Debug Mode:** Only use `?debug=true` when troubleshooting. Don't share these URLs.

2. **Log Files:** The `bootstrap-debug.log` is safe to delete and will be recreated automatically.

3. **Diagnostic Scripts:** Always delete `diagnose-server.php` and `fix-storage-permissions.php` after use.

4. **Permissions:** Storage and bootstrap/cache need 775 (rwxrwxr-x) permissions.

5. **PHP Version:** Your server runs PHP 8.2.28, which is compatible with all packages now.

---

**Good luck with your deployment! 🚀**

If you encounter any issues, check the logs first:
- `storage/logs/bootstrap-debug.log`
- `storage/logs/laravel.log`

Or use debug mode: `?debug=true`
