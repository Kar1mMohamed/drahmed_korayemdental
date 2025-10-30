<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dr. Ahmed Korayem - World-Class Smile Design | Hollywood Smile Makeovers</title>

    <meta name="description"
        content="Experience luxury cosmetic dentistry with Dr. Ahmed Korayem, Egypt's first sustaining member of the American Academy of Cosmetic Dentistry. Transform your smile with 20+ years of artistic excellence.">
    <meta name="author" content="Dr. Ahmed Korayem">

    <!-- Canonical URL -->
    <link rel="canonical" href="{{ url('/') }}">

    <!-- Favicon -->
    <link rel="icon" type="image/jpg" sizes="32x32" href="{{ asset('assets/logo.jpg') }}">
    <link rel="icon" type="image/jpg" sizes="16x16" href="{{ asset('assets/logo.jpg') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/logo.jpg') }}">

    <!-- Open Graph / Social Media -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url('/') }}">
    <meta property="og:title" content="Dr. Ahmed Korayem - World-Class Smile Design">
    <meta property="og:description"
        content="Experience luxury cosmetic dentistry with Dr. Ahmed Korayem, Egypt's first sustaining member of the American Academy of Cosmetic Dentistry.">
    <meta property="og:image" content="{{ asset('assets/logo.png') }}">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Dr. Ahmed Korayem - World-Class Smile Design">
    <meta name="twitter:description"
        content="Luxury cosmetic dentistry by Egypt's first sustaining member of the AACD. Transform your smile today.">
    <meta name="twitter:image" content="{{ asset('assets/logo.png') }}">

    <!-- Preload Critical Image -->
    <link rel="preload" as="image" href="{{ asset('assets/dr-korayem-original.png') }}" fetchpriority="high"
        type="image/png">

    <!-- Google Fonts - Optimized -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&family=Inter:wght@300;400;500;600&display=swap"
        rel="stylesheet" media="print" onload="this.media='all'">
    <noscript>
        <link
            href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&family=Inter:wght@300;400;500;600&display=swap"
            rel="stylesheet">
    </noscript>

    <!-- Image Comparison Slider - Deferred -->
    <link rel="stylesheet" href="https://unpkg.com/img-comparison-slider@8/dist/styles.css" media="print"
        onload="this.media='all'">
    <script type="module" src="https://unpkg.com/img-comparison-slider@8/dist/index.js" defer></script>

    <!-- Vite Assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles

    <!-- Preload Livewire -->
    <link rel="preload" href="/livewire/livewire.js" as="script">
</head>

<body>
    {{-- Hero Section --}}
    @livewire('hero')

    {{-- About Section --}}
    <livewire:about lazy on-load="visible" />

    {{-- Transformations Section --}}
    <livewire:transformation-gallery lazy on-load="visible" />

    {{-- Why Choose Section --}}
    <livewire:why-choose lazy on-load="visible" />

    {{-- Contact Section --}}
    <section id="contact" class="py-12 sm:py-16 md:py-24 bg-black">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-2 gap-8 sm:gap-12 items-center max-w-7xl mx-auto">
                <!-- Left Column - Form -->
                <div class="animate-fade-in-up order-2 md:order-1">
                    <h2
                        class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-heading font-bold mb-4 sm:mb-6 text-white">
                        Ready to Begin Your
                        <br>
                        Smile Journey?
                    </h2>
                    <p class="text-base sm:text-lg text-gray-400 mb-6 sm:mb-8">
                        Fill in your details below and our team will contact you within minutes.
                    </p>

                    @livewire('contact-form')
                </div>

                <!-- Right Column - Image -->
                <div class="relative animate-fade-in-up order-1 md:order-2">
                    <img src="/assets/dr-korayem-original.png" alt="Dr. Ahmed" loading="lazy" decoding="async"
                        fetchpriority="low" class="w-full h-auto object-cover rounded-lg">
                </div>
            </div>
        </div>
    </section>

    {{-- Final CTA Section --}}
    @livewire('final-cta')

    {{-- Footer --}}
    @livewire('footer')

    {{-- WhatsApp Button --}}
    <div class="whatsapp-container">

        <div class="whatsapp-options">

            <a href="https://wa.me/201000081871" target="_blank" rel="noopener noreferrer"
                class="whatsapp-option alexandria-option" aria-label="Contact Alexandria clinic on WhatsApp">

                <div class="option-content">

                    <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">


                        <path
                            d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z" />


                    </svg>

                    <span class="option-text">Alexandria</span>

                </div>

            </a>

            <a href="https://wa.me/201116111135" target="_blank" rel="noopener noreferrer"
                class="whatsapp-option cairo-option" aria-label="Contact Cairo clinic on WhatsApp">

                <div class="option-content">

                    <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">


                        <path
                            d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z" />


                    </svg>

                    <span class="option-text">Cairo</span>

                </div>

            </a>

        </div>

        <div class="whatsapp-button" aria-label="Contact us on WhatsApp">

            <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 24 24">


                <path
                    d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z" />


            </svg>

        </div>

    </div>

    <style>
        .whatsapp-container {

            position: fixed;

            bottom: 1rem;

            right: 1rem;

            z-index: 1000;

        }

        @media (min-width: 640px) {

            .whatsapp-container {

                bottom: 2rem;

                right: 2rem;

            }

        }

        .whatsapp-button {

            width: 50px;

            height: 50px;

            background-color: #25D366;

            border-radius: 50%;

            display: flex;

            align-items: center;

            justify-content: center;

            box-shadow: 0 4px 12px rgba(37, 211, 102, 0.4);

            transition: all 0.3s ease;

            cursor: pointer;

        }

        @media (min-width: 640px) {

            .whatsapp-button {

                width: 60px;

                height: 60px;

            }

        }

        .whatsapp-options {

            position: absolute;

            bottom: 70px;

            right: 0;

            display: flex;

            flex-direction: column;

            gap: 10px;

            opacity: 0;

            visibility: hidden;

            transform: translateY(20px);

            transition: all 0.3s ease;

        }

        @media (min-width: 640px) {

            .whatsapp-options {

                bottom: 80px;

            }

        }

        .whatsapp-container:hover .whatsapp-options {

            opacity: 1;

            visibility: visible;

            transform: translateY(0);

        }

        .whatsapp-container:hover .whatsapp-button {

            transform: scale(1.1);

            box-shadow: 0 6px 16px rgba(37, 211, 102, 0.6);

        }

        .whatsapp-option {

            background-color: #25D366;

            border-radius: 25px;

            padding: 8px 16px;

            box-shadow: 0 4px 12px rgba(37, 211, 102, 0.4);

            transition: all 0.3s ease;

            text-decoration: none;

            min-width: 120px;

        }

        .whatsapp-option:hover {

            background-color: #128C7E;

            transform: translateX(-5px);

            box-shadow: 0 6px 16px rgba(37, 211, 102, 0.6);

        }

        .option-content {

            display: flex;

            align-items: center;

            gap: 8px;

            justify-content: flex-start;

        }

        .option-text {

            color: white;

            font-size: 14px;

            font-weight: 500;

            white-space: nowrap;

        }

        .whatsapp-options::before {

            content: '';

            position: absolute;

            bottom: -10px;

            right: 20px;

            width: 0;

            height: 0;

            border-left: 8px solid transparent;

            border-right: 8px solid transparent;

            border-top: 8px solid #25D366;

        }
    </style>

    <script>
        // Add fade-in animation on scroll
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver(function(entries) {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, observerOptions);

        // Observe all animated elements
        document.querySelectorAll('.animate-fade-in, .animate-fade-in-up').forEach(el => {
            el.style.opacity = '0';
            el.style.transform = 'translateY(20px)';
            el.style.transition = 'opacity 0.6s ease-out, transform 0.6s ease-out';
            observer.observe(el);
        });
    </script>

    @livewireScripts
</body>

</html>
