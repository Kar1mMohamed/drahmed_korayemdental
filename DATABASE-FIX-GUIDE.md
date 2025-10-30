# Database Connection Fix Guide

## Problem Summary

**Error:** `SQLSTATE[HY000] [2002] Connection timed out`

**Root Cause:** Database credentials in `.env` file were incorrect or cached.

**Your Correct Credentials:**
```env
DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=u917077655_drahmed
DB_USERNAME=u917077655_drahmed
DB_PASSWORD="4SnmPXUn="
```

---

## Quick Fix (5 Minutes)

### Option A: Automated Fix (Recommended)

```bash
# 1. Upload scripts to server
# Upload: update-env-credentials.php, clear-all-caches.php,
#         test-db-connection.php, run-migrations-safe.php

# 2. Run the fix sequence
php update-env-credentials.php
php clear-all-caches.php
php test-db-connection.php
php run-migrations-safe.php

# 3. Clean up
rm update-env-credentials.php clear-all-caches.php test-db-connection.php run-migrations-safe.php
```

### Option B: Manual Fix

```bash
# 1. Update .env file on server
vi .env
# Update database credentials to match above

# 2. Clear Laravel caches
php artisan config:clear
php artisan cache:clear
php artisan view:clear

# 3. Clear bootstrap cache
rm bootstrap/cache/*.php

# 4. Test connection
php artisan migrate:status

# 5. Run migrations
php artisan migrate --force
```

---

## Detailed Step-by-Step Guide

### Step 1: Verify Database Credentials

**In Hostinger Control Panel:**

1. Log into Hostinger
2. Go to **Databases** → **MySQL Databases**
3. Verify these match your database:
   - Database name: `u917077655_drahmed`
   - Username: `u917077655_drahmed`
   - Password: `4SnmPXUn=`

### Step 2: Upload Fix Scripts

Upload these files to your server root:
```
/home/u917077655/domains/korayemdental.com/public_html/drahmed/
├── update-env-credentials.php
├── clear-all-caches.php
├── test-db-connection.php
└── run-migrations-safe.php
```

### Step 3: Update .env File

**Run the update script:**
```bash
php update-env-credentials.php
```

**What it does:**
- ✅ Backs up your current `.env` file
- ✅ Updates database credentials
- ✅ Tests the connection
- ✅ Shows what was changed

**Expected output:**
```
=== Update Database Credentials in .env ===

✓ .env file found
✓ Backup created: .env.backup.2025-10-30_180000

Current database configuration:
  ✗ DB_HOST: 127.0.0.1 → localhost
  ✗ DB_DATABASE: u917077655_korayem → u917077655_drahmed
  ✗ DB_USERNAME: u917077655_korayem → u917077655_drahmed
  ✗ DB_PASSWORD: *** → ***

✓ .env file updated successfully
✓ Database connection successful!
```

### Step 4: Clear All Caches

**Run the cache clearer:**
```bash
php clear-all-caches.php
```

**What it does:**
- ✅ Clears config cache (removes cached .env values)
- ✅ Clears application cache
- ✅ Clears route cache
- ✅ Clears view cache
- ✅ Removes compiled files
- ✅ Shows current configuration

**Why this is critical:**
Laravel caches the database configuration for performance. Even after updating `.env`, the old cached values will be used until you clear the cache.

### Step 5: Test Database Connection

**Run the connection tester:**
```bash
php test-db-connection.php
```

**What it does:**
- ✅ Shows what's in your `.env` file
- ✅ Tests direct PDO connection
- ✅ Lists all database tables
- ✅ Checks if `sessions` table exists
- ✅ Compares `.env` vs cached config

**Expected output if working:**
```
=== Database Connection Diagnostic ===

✓ Direct PDO connection successful!

Server Information:
  MySQL Version: 8.0.x

Connection Details:
  Connected to database: u917077655_drahmed
  Connected as user: u917077655_drahmed@localhost

✓ 'sessions' table exists
  Total sessions: 0

All tables in database:
  - migrations
  - sessions
  - users
  - cache
  ...
```

### Step 6: Run Migrations

**Run the migration script:**
```bash
php run-migrations-safe.php
```

**What it does:**
- ✅ Tests database connection first
- ✅ Shows current tables
- ✅ Runs `php artisan migrate --force`
- ✅ Creates `sessions` table if missing
- ✅ Verifies tables were created

**Expected output:**
```
=== Run Laravel Migrations ===

✓ Database connection successful

Current tables (0):
  (No tables yet)

✓ Migrations completed successfully

Database now has 5 tables:
  ✓ NEW migrations
  ✓ NEW users
  ✓ NEW sessions
  ✓ NEW cache
  ✓ NEW password_reset_tokens

✓ Sessions table exists
```

### Step 7: Clean Up

**Delete diagnostic scripts:**
```bash
rm update-env-credentials.php
rm clear-all-caches.php
rm test-db-connection.php
rm run-migrations-safe.php
```

**Security Note:** These scripts contain sensitive information and should not remain on your server.

---

## Common Issues & Solutions

### Issue 1: Still Getting "Access Denied"

**Symptoms:**
```
❌ Database connection FAILED: SQLSTATE[HY000] [1045] Access denied
```

**Solutions:**

1. **Verify credentials in Hostinger:**
   - Log into Hostinger control panel
   - Check exact database name, username, and password
   - Password is case-sensitive!

2. **Try localhost instead of 127.0.0.1:**
   ```env
   DB_HOST=localhost  # Not 127.0.0.1
   ```

3. **Check for quotes in password:**
   ```env
   # If password has special characters, use quotes:
   DB_PASSWORD="4SnmPXUn="
   ```

### Issue 2: Database Doesn't Exist

**Symptoms:**
```
❌ SQLSTATE[HY000] [1049] Unknown database 'u917077655_drahmed'
```

**Solution:**
Create the database in Hostinger control panel:
1. Go to **Databases** → **MySQL Databases**
2. Click **Create Database**
3. Name it exactly: `u917077655_drahmed`

### Issue 3: Configuration Still Cached

**Symptoms:**
- `.env` file is correct
- Connection test fails
- Laravel shows old database name

**Solution:**
```bash
# Forcefully clear all caches
php artisan config:clear
php artisan cache:clear
rm bootstrap/cache/*.php
rm storage/framework/cache/data/*

# Verify it worked
php artisan config:show database.connections.mysql
```

### Issue 4: Sessions Table Not Created

**Symptoms:**
```
❌ SQLSTATE[42S02]: Base table or view not found: 'sessions'
```

**Solution:**
```bash
# Create sessions migration
php artisan session:table

# Run migrations
php artisan migrate --force

# Verify
php artisan migrate:status
```

### Issue 5: Permission Denied

**Symptoms:**
```
Warning: file_put_contents(.env): failed to open stream: Permission denied
```

**Solution:**
```bash
# Fix .env file permissions
chmod 644 .env

# Fix storage permissions
chmod -R 775 storage bootstrap/cache
```

---

## Understanding the Error

### Why "Connection timed out"?

The error occurs because:

1. **Wrong host:** Using `127.0.0.1` instead of `localhost`
   - `127.0.0.1` = TCP/IP connection
   - `localhost` = Unix socket connection (faster, more reliable on shared hosting)

2. **Wrong credentials:** Database name/username/password mismatch

3. **Cached config:** Laravel cached the old (wrong) credentials

### Why "Sessions" Table Required?

Your app uses database sessions (`SESSION_DRIVER=database` in `.env`).

When a user visits your site, Laravel tries to:
1. Start a session
2. Query the `sessions` table
3. Store session data

If the table doesn't exist → Error!

---

## Verification Checklist

After running all scripts, verify:

- [ ] `.env` file has correct database credentials
- [ ] `php artisan config:show database` shows correct values
- [ ] `php artisan migrate:status` shows migrations ran
- [ ] `sessions` table exists in database
- [ ] Website loads without 500 errors
- [ ] Can navigate different pages
- [ ] Diagnostic scripts deleted

---

## Alternative: Switch to File Sessions (Temporary)

If you can't fix the database connection immediately, switch to file-based sessions:

**In `.env` file:**
```env
SESSION_DRIVER=file  # Change from 'database'
```

**Clear cache:**
```bash
php artisan config:clear
```

**Benefits:**
- ✅ Site works immediately
- ✅ No database connection needed for sessions
- ✅ Good temporary solution

**Drawbacks:**
- ⚠ Sessions not shared across multiple servers
- ⚠ Slower than database on high traffic
- ⚠ Not recommended for production

---

## Production Checklist

Before deploying to production:

### Security
- [ ] `APP_DEBUG=false` in `.env`
- [ ] `APP_ENV=production` in `.env`
- [ ] Delete all diagnostic PHP scripts
- [ ] Remove `.env.backup.*` files
- [ ] Verify database password is strong

### Performance
- [ ] Run `php artisan config:cache`
- [ ] Run `php artisan route:cache`
- [ ] Run `php artisan view:cache`
- [ ] Run `php artisan event:cache`
- [ ] Enable OPcache in PHP

### Database
- [ ] All migrations ran successfully
- [ ] `sessions` table exists
- [ ] Database user has correct permissions
- [ ] Regular database backups configured

---

## Quick Reference Commands

```bash
# Test database connection
php artisan migrate:status

# Clear specific cache
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear

# Clear ALL caches
php artisan optimize:clear

# Rebuild caches (production)
php artisan optimize

# Run migrations
php artisan migrate --force

# Check current config
php artisan config:show database

# Create sessions table
php artisan session:table
php artisan migrate --force
```

---

## Need Help?

### Check Laravel Logs
```bash
tail -50 storage/logs/laravel.log
```

### Check Bootstrap Logs
```bash
cat storage/logs/bootstrap-debug.log
```

### Test Direct MySQL Connection
```bash
mysql -h localhost -u u917077655_drahmed -p u917077655_drahmed
# Enter password: 4SnmPXUn=
```

### Verify PHP Version
```bash
php -v
# Should be 8.2+
```

---

## Files Created for This Fix

1. **update-env-credentials.php** - Updates `.env` with correct database credentials
2. **clear-all-caches.php** - Clears all Laravel caches
3. **test-db-connection.php** - Tests and diagnoses database connection
4. **run-migrations-safe.php** - Runs migrations to create tables
5. **DATABASE-FIX-GUIDE.md** - This documentation file

**Remember:** Delete all `.php` diagnostic files after use for security!

---

## Success Indicators

Your database is fixed when:

✅ `php test-db-connection.php` shows: "Database connection successful"
✅ Website loads without 500 errors
✅ No errors in `storage/logs/laravel.log`
✅ `sessions` table visible in database
✅ Can log in / navigate the site

🎉 **Congratulations! Your database is now properly configured!**
