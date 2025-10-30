<section id="hero"
    class="relative min-h-screen flex items-center justify-center gradient-hero overflow-hidden text-center">
    <!-- الخلفية -->
    <div class="absolute inset-0 z-0"
        style="background-image: url('{{ $heroImage }}'); 
               background-position: center 60%;    
               background-size: cover; 
               background-repeat: no-repeat;
               opacity: 0.4;
               transform: scale(1.05);">
    </div>
    <div class="absolute inset-0 z-0 bg-gradient-to-b from-black/70 via-black/50 to-black/80"></div>

    <!-- المحتوى -->
    <div class="relative z-10 flex flex-col items-center justify-center px-4 sm:px-6 lg:px-8 max-w-5xl mx-auto">
        <h1
            class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl xl:text-8xl font-heading font-bold mb-4 sm:mb-6 text-shadow-luxury leading-tight">
            {{ $title }}<br>
            <span class="text-accent">{{ $subtitle }}</span>
        </h1>

        <p
            class="text-base sm:text-lg md:text-xl text-muted-foreground max-w-3xl mx-auto mb-8 sm:mb-12 font-light leading-relaxed">
            {{ $description }}
        </p>

        <div class="flex flex-col sm:flex-row gap-4 sm:gap-6 justify-center items-center">
            <button onclick="scrollToSection('contact')" class="btn-hero w-full sm:w-auto sm:min-w-[280px]">
                Book Your Consultation Now
            </button>

            <button onclick="scrollToSection('transformations')"
                class="btn-ghost-outline w-full sm:w-auto sm:min-w-[280px]">
                See Real Results
            </button>
        </div>
    </div>

    <!-- السهم في الأسفل -->
    <div class="absolute bottom-12 left-1/2 -translate-x-1/2 z-10 animate-bounce">
        <svg class="w-8 h-8 text-accent opacity-70" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
        </svg>
    </div>
</section>
