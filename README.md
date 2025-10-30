# Dr. Ahmed Korayem - Landing Page

Landing page فاخر لطبيب أسنان مبني بـ Laravel + Livewire

## المميزات

- ✨ تصميم أسود وأبيض راقي
- 📱 Responsive تماماً
- ⚡ Livewire للـ Contact Form
- 💾 حفظ الرسائل في Database
- 🎨 Tailwind CSS v4 (مع Vite)
- 📧 Contact Form مع Validation
- 🖼️ Image Comparison Slider للتحولات
- 🚀 **محسّن للأداء**: Lazy loading, WebP, Font optimization

## التثبيت

1. Clone المشروع
2. نسخ `.env.example` إلى `.env`
3. تشغيل:

```bash
composer install
npm install
php artisan key:generate
php artisan migrate
npm run build
```

## تشغيل المشروع

### للتطوير (Development)

```bash
# Terminal 1: Laravel Server
php artisan serve

# Terminal 2: Vite Dev Server
npm run dev
```

### للإنتاج (Production)

```bash
# بناء الـ assets
npm run build

# تشغيل السيرفر
php artisan serve
```

ثم افتح: http://localhost:8000

## الصور المطلوبة

ضع الصور التالية في `public/assets/`:

- `dr-korayem-original.png` - صورة الدكتور للـ Hero
- `dentist-working.jpg` - صورة الدكتور في العمل
- `before-1.jpg` - صورة قبل
- `after-1.jpg` - صورة بعد
- `testimonial-1.jpg` - صورة العميل الأول
- `testimonial-2.jpg` - صورة العميل الثاني

## البنية

- **Model**: `App\Models\Contact` - لحفظ رسائل التواصل
- **Livewire Component**: `App\Livewire\ContactForm` - فورم التواصل
- **View**: `resources/views/welcome.blade.php` - الصفحة الرئيسية
- **Database**: SQLite (يمكن تغييرها لـ MySQL)

## الأقسام

1. Hero Section - القسم الرئيسي
2. About Section - عن الدكتور
3. Transformations - قبل وبعد
4. Why Choose - لماذا تختارنا
5. Contact Form - فورم التواصل (Livewire)
6. Testimonials - آراء العملاء
7. Footer - معلومات التواصل

## التخصيص

- غير أرقام الهاتف في الـ Footer و WhatsApp Button
- غير البريد الإلكتروني
- غير العناوين والنصوص حسب الحاجة
- أضف الصور الحقيقية

## التقنيات المستخدمة

- Laravel 12
- Livewire 3
- Tailwind CSS
- SQLite/MySQL
- Google Fonts (Playfair Display + Inter)

---

## 📚 التوثيق

للمزيد من المعلومات، راجع:

- **[QUICK_START.md](QUICK_START.md)** - دليل البدء السريع ⚡
- **[DEVELOPMENT.md](DEVELOPMENT.md)** - دليل التطوير الشامل 🛠️
- **[PROJECT_STRUCTURE.md](PROJECT_STRUCTURE.md)** - بنية المشروع 🏗️
- **[DEPLOYMENT_GUIDE.md](DEPLOYMENT_GUIDE.md)** - دليل النشر 🚀
- **[DOCS_INDEX.md](DOCS_INDEX.md)** - فهرس جميع الملفات 📚
- **[PERFORMANCE_OPTIMIZATIONS.md](PERFORMANCE_OPTIMIZATIONS.md)** - تحسينات الأداء 🚀
- **[QUICK_PERFORMANCE_GUIDE.md](QUICK_PERFORMANCE_GUIDE.md)** - دليل سريع للأداء ⚡

---

© 2026 Dr. Ahmed Korayem
