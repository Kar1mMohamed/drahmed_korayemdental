# Debugging Guide - "Please provide a valid cache path" Error

## Quick Reference

Your application now has enhanced logging to help diagnose the error on your server.

---

## Method 1: View Debug Output in Browser (Easiest)

### Step 1: Enable Debug Mode
Add `?debug=true` to any URL:
```
https://drahmed.korayemdental.com/?debug=true
```

### What You'll See:
The page will display detailed bootstrap information before the error, including:
- Current working directory
- Status of all storage directories (EXISTS/MISSING/WRITABLE)
- Each step of the bootstrap process
- The exact error message and stack trace

### Example Output:
```
[2025-10-30 22:01:27] === Bootstrap Started ===
[2025-10-30 22:01:27] Views directory: MISSING - /path/to/storage/framework/views
[2025-10-30 22:01:27] ERROR bootstrapping Laravel: Please provide a valid cache path.
```

---

## Method 2: Check the Log File (More Detailed)

### Via SSH:
```bash
cd /home/u781510023/domains/drahmed.korayemdental.com
cat storage/logs/bootstrap-debug.log
```

### Via File Manager:
Navigate to: `storage/logs/bootstrap-debug.log` and download/view it.

### Via PHP Script:
Create `view-log.php`:
```php
<?php
echo "<pre>";
echo file_get_contents(__DIR__ . '/storage/logs/bootstrap-debug.log');
echo "</pre>";
```
Visit: `https://drahmed.korayemdental.com/view-log.php`
**DELETE THIS FILE AFTER USE!**

---

## Method 3: Run Complete Diagnostic (Most Comprehensive)

### Upload and Run:
1. Upload `diagnose-server.php` to your server root
2. Visit: `https://drahmed.korayemdental.com/diagnose-server.php`
3. Review the complete diagnostic report

This will show:
- PHP version and extensions
- All directory statuses
- File permissions
- Recent Laravel logs
- Server configuration
- Quick fix commands

**DELETE THIS FILE AFTER USE!**

---

## Common Issues and Solutions

### Issue 1: Views Directory Missing
**Log shows:**
```
Views directory: MISSING - /path/to/storage/framework/views
```

**Solution:**
```bash
mkdir -p storage/framework/views
chmod 775 storage/framework/views
echo "*" > storage/framework/views/.gitignore
echo "!.gitignore" >> storage/framework/views/.gitignore
```

### Issue 2: Views Directory Not Writable
**Log shows:**
```
Views directory: EXISTS BUT NOT WRITABLE
```

**Solution:**
```bash
chmod -R 775 storage
chmod -R 775 bootstrap/cache
```

### Issue 3: Logs Directory Missing
**Log shows:**
```
WARNING: Could not write to log file
```

**Solution:**
```bash
mkdir -p storage/logs
chmod 775 storage/logs
```

### Issue 4: Wrong Path (Composer Install Location Issue)
**Log shows:**
```
Autoloader: MISSING - /wrong/path/vendor/autoload.php
```

**Solution:**
This means composer installed in wrong location. Check:
```bash
pwd  # Should be in your domain root
ls -la vendor/  # Should exist here
```

---

## Automated Fix Script

Use the automated fix script for all common issues:

```bash
cd /home/u781510023/domains/drahmed.korayemdental.com
php fix-storage-permissions.php
```

This will:
- Create all missing directories
- Set correct permissions (775)
- Create .gitignore files
- Clear corrupted cache
- Verify everything is writable

---

## Step-by-Step Debugging Process

### Step 1: Enable Debug Mode
Visit: `https://drahmed.korayemdental.com/?debug=true`

### Step 2: Identify the Issue
Look for lines showing:
- `MISSING` - Directory doesn't exist
- `NOT WRITABLE` - Permission issue
- `ERROR` - The actual error message

### Step 3: Fix the Issue
Based on what you found:
- Missing directories → Run fix script or create manually
- Not writable → Run `chmod -R 775 storage bootstrap/cache`
- Path issues → Check composer installation location

### Step 4: Clear Caches
```bash
php artisan config:clear
php artisan cache:clear
php artisan view:clear
```

### Step 5: Test Again
Visit your site normally (without ?debug=true)

---

## Understanding the Bootstrap Process

The application loads in this order:

1. **Bootstrap Started** ← Logs begin here
2. **Path Verification** ← Checks all directories
3. **Maintenance Mode Check** ← Loads maintenance.php if exists
4. **Composer Autoloader** ← Loads vendor/autoload.php
5. **Laravel Bootstrap** ← Loads bootstrap/app.php ← ERROR USUALLY HERE
6. **Request Handling** ← Processes the HTTP request

The log will show exactly where it fails!

---

## Log File Locations

### Bootstrap Debug Log:
`storage/logs/bootstrap-debug.log`
- Shows detailed startup process
- Updated on every request
- Safe to delete (will be recreated)

### Laravel Application Log:
`storage/logs/laravel.log`
- Shows application errors
- Stack traces
- Database query errors

---

## Security Notes

### After Debugging, Remove:
```bash
# Remove diagnostic scripts
rm diagnose-server.php
rm view-log.php

# Disable debug mode in .env
APP_DEBUG=false
```

### Keep Debug URLs Private:
- Don't share URLs with `?debug=true`
- Only use when troubleshooting
- Contains sensitive path information

---

## When Running Composer Install

### On Server via SSH:
```bash
cd /home/u781510023/domains/drahmed.korayemdental.com

# Before composer install, ensure directories exist:
php fix-storage-permissions.php

# Then run composer:
composer install --no-dev --optimize-autoloader

# Check the bootstrap log for any issues:
cat storage/logs/bootstrap-debug.log
```

### Expected Log Output (Success):
```
[timestamp] === Bootstrap Started ===
[timestamp] Views directory: EXISTS & WRITABLE
[timestamp] Cache directory: EXISTS & WRITABLE
[timestamp] Composer autoloader loaded successfully
[timestamp] Laravel application bootstrapped successfully
[timestamp] Request handled successfully
```

### Expected Log Output (Error):
```
[timestamp] === Bootstrap Started ===
[timestamp] Views directory: MISSING
[timestamp] ERROR bootstrapping Laravel: Please provide a valid cache path.
```

---

## Still Having Issues?

### 1. Check PHP Version on Server:
```bash
php -v
# Should be 8.2+
```

### 2. Verify Composer Installed Correctly:
```bash
ls -la vendor/laravel/framework
# Should exist
```

### 3. Check File Ownership:
```bash
ls -la storage/
# All files should be owned by your user
```

### 4. Verify .env File:
```bash
cat .env | grep APP_KEY
# Should have a key set
```

### 5. Contact Support With:
- The complete `bootstrap-debug.log` file
- The output from `diagnose-server.php`
- Your PHP version (`php -v`)
- Directory permissions (`ls -la storage/`)

---

## Quick Commands Cheat Sheet

```bash
# View bootstrap log
cat storage/logs/bootstrap-debug.log

# View Laravel log
tail -50 storage/logs/laravel.log

# Fix permissions
chmod -R 775 storage bootstrap/cache

# Create missing directories
mkdir -p storage/framework/{cache/data,sessions,views}

# Clear all caches
php artisan config:clear && php artisan cache:clear && php artisan view:clear

# Run fix script
php fix-storage-permissions.php

# Test artisan
php artisan --version

# Check directory status
ls -la storage/framework/

# Full diagnostic
php diagnose-server.php > diagnostic-report.txt
```

---

## Files Reference

### Enhanced Files:
- `public/index.php` - Now has detailed logging
- `fix-storage-permissions.php` - Automated fix script
- `diagnose-server.php` - Complete diagnostic tool
- `SERVER-SETUP-GUIDE.md` - Deployment guide
- `DEBUGGING-GUIDE.md` - This file

### Logs:
- `storage/logs/bootstrap-debug.log` - Bootstrap process log
- `storage/logs/laravel.log` - Application log

Remember: Always delete diagnostic scripts after use for security!
