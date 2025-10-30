# Server Setup Guide - Hostinger Deployment

## Issue: "Please provide a valid cache path" Error

This error occurs when Laravel's storage directories don't exist or lack proper permissions on the server.

## Quick Fix (On Your Server)

### Step 1: Upload the Fix Script
Upload `fix-storage-permissions.php` to your server's root directory (same level as `composer.json`).

### Step 2: Run the Fix Script via SSH or File Manager

**Option A: Via SSH (Recommended)**
```bash
cd /home/u781510023/domains/drahmed.korayemdental.com
php fix-storage-permissions.php
```

**Option B: Via Browser (If SSH not available)**
Create a temporary file `run-fix.php` with:
```php
<?php
include 'fix-storage-permissions.php';
```
Then visit: `https://drahmed.korayemdental.com/run-fix.php`
**DELETE THIS FILE IMMEDIATELY AFTER USE!**

### Step 3: Clear Laravel Caches
```bash
php artisan config:clear
php artisan cache:clear
php artisan view:clear
```

### Step 4: Run Composer Install
```bash
composer install --no-dev --optimize-autoloader
```

---

## Manual Fix (If Script Doesn't Work)

### Create Required Directories
```bash
mkdir -p storage/framework/cache/data
mkdir -p storage/framework/sessions
mkdir -p storage/framework/testing
mkdir -p storage/framework/views
mkdir -p storage/logs
mkdir -p storage/app/public
mkdir -p storage/app/private
mkdir -p bootstrap/cache
```

### Set Permissions
```bash
chmod -R 775 storage
chmod -R 775 bootstrap/cache
```

### Create .gitignore Files

**storage/framework/views/.gitignore:**
```
*
!.gitignore
```

**storage/framework/cache/data/.gitignore:**
```
*
!.gitignore
```

**storage/framework/sessions/.gitignore:**
```
*
!.gitignore
```

**storage/logs/.gitignore:**
```
*
!.gitignore
```

**bootstrap/cache/.gitignore:**
```
*
!.gitignore
```

---

## Deployment Checklist

### Pre-Deployment (Local)
- [ ] Ensure `.env.example` is up to date
- [ ] Test locally: `php artisan config:clear && php artisan test`
- [ ] Build assets: `npm run build`
- [ ] Commit all changes: `git add . && git commit -m "Deployment ready"`
- [ ] Push to repository: `git push`

### On Server
- [ ] Upload/pull latest code
- [ ] Upload `.env` file (if not already present)
- [ ] Run fix script: `php fix-storage-permissions.php`
- [ ] Install dependencies: `composer install --no-dev --optimize-autoloader`
- [ ] Clear caches: `php artisan config:clear`
- [ ] Run migrations: `php artisan migrate --force`
- [ ] Create storage link: `php artisan storage:link`
- [ ] Optimize for production: `php artisan optimize`
- [ ] Test the site!

---

## Common Hostinger-Specific Issues

### Issue 1: PHP Version Mismatch
**Solution:** Ensure Hostinger is using PHP 8.2+
- Go to Hostinger Control Panel → Advanced → PHP Configuration
- Select PHP 8.2 or higher
- Your `composer.json` is configured for PHP 8.2+ compatibility

### Issue 2: Composer Not Found
**Solution:** Use full path to composer
```bash
/usr/local/bin/php /usr/local/bin/composer install --no-dev --optimize-autoloader
```

### Issue 3: Memory Limit Errors
**Solution:** Increase PHP memory limit
```bash
php -d memory_limit=512M /usr/local/bin/composer install --no-dev --optimize-autoloader
```

### Issue 4: Storage Symlink Fails
**Solution:** Use relative symlinks
```bash
php artisan storage:link
```
Or manually create:
```bash
cd public
ln -s ../storage/app/public storage
```

---

## Production Optimization

After successful deployment, run:
```bash
# Clear all caches
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear

# Optimize for production
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan event:cache
```

---

## Troubleshooting

### Check PHP Version
```bash
php -v
```

### Check Directory Permissions
```bash
ls -la storage/
ls -la storage/framework/
ls -la bootstrap/cache/
```

### Check Laravel Version
```bash
php artisan --version
```

### View Laravel Logs
```bash
tail -n 50 storage/logs/laravel.log
```

### Test Configuration
```bash
php artisan config:show app
```

---

## Environment Variables Checklist

Ensure your `.env` file on the server has:
```env
APP_ENV=production
APP_DEBUG=false
APP_URL=https://drahmed.korayemdental.com

# Database (Hostinger)
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=u917077655_korayem
DB_USERNAME=u917077655_korayem
DB_PASSWORD=your_password_here

# Sessions & Cache
SESSION_DRIVER=database
CACHE_STORE=database
QUEUE_CONNECTION=database
```

---

## Security Notes

⚠️ **Important:**
1. Never commit `.env` files to version control
2. Set `APP_DEBUG=false` in production
3. Keep `APP_KEY` secret and unique
4. Use HTTPS (SSL) for production
5. Delete any temporary fix scripts after use
6. Regularly update dependencies: `composer update`

---

## Support

If issues persist:
1. Check `storage/logs/laravel.log`
2. Enable debug temporarily: `APP_DEBUG=true` (remember to disable after)
3. Contact Hostinger support for server-specific issues
4. Verify PHP version matches requirements (8.2+)
