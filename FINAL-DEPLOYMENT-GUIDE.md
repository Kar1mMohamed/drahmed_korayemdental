# 🚀 Dr. Ahmed Korayem Website - Final Deployment Guide

## 📋 Server Information
- **Domain:** `https://drahmed.korayemdental.com` (subdomain)
- **Server Path:** `/home/u917077655/domains/korayemdental.com/public_html/drahmed`
- **Database:** `u917077655_korayem`
- **PHP Required:** 8.2+ (Laravel 11 requirement)

---

## 🌐 **Domain Configuration**
The subdomain `drahmed.korayemdental.com` should point directly to the `/drahmed` directory:
- **Subdomain:** `drahmed.korayemdental.com`
- **Document Root:** `/home/u917077655/domains/korayemdental.com/public_html/drahmed/public`
- **Access URL:** `https://drahmed.korayemdental.com`

## 📋 **Pre-Deployment Checklist**

### 1. **Update PHP Version in Hostinger**
- Login to **Hostinger hPanel**
- Go to **Advanced → PHP Configuration**
- Select domain: `korayemdental.com`
- **Change PHP Version to: 8.2 or 8.3**
- Click **Save**

### 2. **Database Setup**
- Database Name: `u917077655_korayem`
- Database User: `u917077655_korayem`
- Password: `karim123` (update if needed)

---

## 📁 **File Upload Instructions**

### **Step 1: Upload Laravel Files**
Upload all Laravel files to: `/home/u917077655/domains/korayemdental.com/public_html/drahmed/`

**Directory Structure:**
```
/home/u917077655/domains/korayemdental.com/public_html/drahmed/
├── app/
├── bootstrap/
├── config/
├── database/
├── public/
├── resources/
├── routes/
├── storage/
├── vendor/
├── .env
├── artisan
├── composer.json
└── composer.lock
```

### **Step 2: Update index.php**
Replace the content of `public_html/index.php` with the content from `index-hostinger-final.php`:

```php
<?php

use Illuminate\Contracts\Http\Kernel;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// Correct Hostinger path for korayemdental.com/drahmed
$maintenance = '/home/u917077655/domains/korayemdental.com/public_html/drahmed/storage/framework/maintenance.php';

if (file_exists($maintenance)) {
    require $maintenance;
}

require '/home/u917077655/domains/korayemdental.com/public_html/drahmed/vendor/autoload.php';

$app = require_once '/home/u917077655/domains/korayemdental.com/public_html/drahmed/bootstrap/app.php';

$kernel = $app->make(Kernel::class);

$response = $kernel->handle(
    $request = Request::capture()
)->send();

$kernel->terminate($request, $response);
```

### **Step 3: Upload .env File**
Upload the updated `.env` file with these key settings:
```env
APP_URL=https://korayemdental.com/drahmed
DB_DATABASE=u917077655_korayem
DB_USERNAME=u917077655_korayem
MAIL_USERNAME=info@korayemdental.com
MAIL_FROM_ADDRESS="info@korayemdental.com"
```

---

## 🔧 **Post-Upload Configuration**

### **1. Set File Permissions**
```bash
chmod -R 755 /home/u917077655/domains/korayemdental.com/public_html/drahmed/storage
chmod -R 755 /home/u917077655/domains/korayemdental.com/public_html/drahmed/bootstrap/cache
```

### **2. Create Storage Symlink**
```bash
cd /home/u917077655/domains/korayemdental.com/public_html/drahmed
php artisan storage:link
```

### **3. Run Database Migrations**
```bash
php artisan migrate --force
```

### **4. Clear and Cache Configuration**
```bash
php artisan config:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

---

## 🔍 **Testing & Diagnostics**

### **1. Upload Diagnostic Script**
Upload `diagnose-final.php` to your public_html directory and visit:
**https://drahmed.korayemdental.com/diagnose-final.php**

### **2. Test Website**
Visit: **https://drahmed.korayemdental.com**

### **3. Common Issues & Solutions**

#### **HTTP 500 Error**
- Check PHP version is 8.2+
- Verify file permissions (755 for storage and bootstrap/cache)
- Check error logs in hPanel

#### **Database Connection Error**
- Verify database credentials in .env
- Ensure database exists in hPanel
- Check database user permissions

#### **Assets Not Loading**
- Run `php artisan storage:link`
- Check public directory permissions
- Verify APP_URL in .env

---

## 📧 **Email Configuration**
```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.hostinger.com
MAIL_PORT=465
MAIL_USERNAME=info@korayemdental.com
MAIL_PASSWORD=^jsc|rX[Uy7
MAIL_ENCRYPTION=ssl
MAIL_FROM_ADDRESS="info@korayemdental.com"
```

---

## 🔒 **Security Checklist**

- [ ] Delete diagnostic files after use
- [ ] Ensure .env file is not publicly accessible
- [ ] Set proper file permissions
- [ ] Enable SSL certificate
- [ ] Update APP_KEY if needed

---

## 🚀 **Final Steps**

1. **Upload all files** to `/home/u917077655/domains/korayemdental.com/public_html/drahmed/`
2. **Replace index.php** with the corrected version
3. **Set file permissions** (755 for storage and bootstrap/cache)
4. **Run diagnostic script** to verify setup
5. **Test website** at https://drahmed.korayemdental.com
6. **Delete diagnostic files** for security

---

## 📞 **Support**

If you encounter issues:
1. Check Hostinger error logs in hPanel
2. Run the diagnostic script
3. Contact Hostinger support if server-related
4. Verify all paths and permissions

**🎉 Your Dr. Ahmed Korayem dental website should now be live at:**
**https://drahmed.korayemdental.com**