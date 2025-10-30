# Assets Directory

## 📁 بنية المجلد

```
assets/
├── 1/
│   ├── before-1.JPG
│   └── after-1.JPG
├── 2/
│   ├── before-2.JPG
│   └── after-2.JPG
├── ...
├── 12/
│   ├── before-12.JPG
│   └── after-12.JPG
├── dr-korayem-original.png
├── dentist-working.jpg
├── testimonial-1.jpg
└── testimonial-2.jpg
```

## 🖼️ الصور المطلوبة

### صور التحولات (Before/After)

يجب وضع 12 زوج من الصور في مجلدات منفصلة:

- **المجلد 1**: `1/before-1.JPG` و `1/after-1.JPG`
- **المجلد 2**: `2/before-2.JPG` و `2/after-2.JPG`
- **...**
- **المجلد 12**: `12/before-12.JPG` و `12/after-12.JPG`

### صور أخرى

- **dr-korayem-original.png**: صورة الدكتور للـ Hero Section
- **dentist-working.jpg**: صورة الدكتور في العمل للـ About Section
- **testimonial-1.jpg**: صورة العميل الأول
- **testimonial-2.jpg**: صورة العميل الثاني

## ⚙️ المواصفات

### صور التحولات (Before/After)

- **الصيغة**: JPG (حروف كبيرة)
- **الحجم المقترح**: 800x800 بكسل (مربع)
- **الجودة**: عالية (80-90%)
- **الحجم**: أقل من 500 KB لكل صورة

### صور أخرى

- **dr-korayem-original.png**:
    - الصيغة: PNG
    - الحجم المقترح: 1920x1080 بكسل
    - خلفية شفافة أو سوداء

- **dentist-working.jpg**:
    - الصيغة: JPG
    - الحجم المقترح: 1200x800 بكسل
    - الجودة: عالية

- **testimonial-\*.jpg**:
    - الصيغة: JPG
    - الحجم المقترح: 400x400 بكسل (مربع)
    - الجودة: متوسطة-عالية

## 🔧 التحسين

### ضغط الصور

استخدم أدوات مثل:

- [TinyPNG](https://tinypng.com/)
- [ImageOptim](https://imageoptim.com/)
- [Squoosh](https://squoosh.app/)

### تحويل الصيغ

```bash
# تحويل PNG إلى JPG
convert input.png -quality 85 output.JPG

# تغيير الحجم
convert input.jpg -resize 800x800 output.JPG
```

## 📝 ملاحظات

1. **أسماء الملفات**: يجب أن تكون بالضبط كما هو موضح (حروف كبيرة لـ JPG)
2. **المجلدات**: يجب إنشاء مجلد منفصل لكل تحول (1-12)
3. **الحجم**: حاول أن تكون الصور أقل من 500 KB لتحسين الأداء
4. **الجودة**: استخدم جودة عالية للصور الرئيسية، متوسطة للصور الثانوية

## 🚀 الاستخدام

الصور يتم استخدامها في:

- **Hero Section**: `dr-korayem-original.png`
- **About Section**: `dentist-working.jpg`
- **Transformations Section**: `1/before-1.JPG` إلى `12/after-12.JPG`
- **Testimonials Section**: `testimonial-1.jpg`, `testimonial-2.jpg`

## 🔍 التحقق

للتحقق من وجود جميع الصور:

```bash
# Windows
dir /s *.JPG
dir /s *.jpg
dir /s *.png

# Linux/Mac
find . -name "*.JPG"
find . -name "*.jpg"
find . -name "*.png"
```

## ⚠️ تحذيرات

- **لا تحذف** مجلد `.gitkeep`
- **لا ترفع** صور كبيرة جداً (أكثر من 2 MB)
- **تأكد** من أن الصور ذات جودة عالية
- **احتفظ** بنسخة احتياطية من الصور الأصلية
