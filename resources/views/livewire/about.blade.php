<section id="about" class="py-12 sm:py-16 md:py-24 gradient-section loading-fade-in">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid md:grid-cols-2 gap-8 sm:gap-12 lg:gap-16 items-center">
            <div class="space-y-6 sm:space-y-8 animate-fade-in-up delay-100">
                <div>
                    <div class="w-12 sm:w-16 h-px bg-accent mb-4 sm:mb-6"></div>
                    <h2 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-heading font-bold mb-4 sm:mb-6">
                        {{ $title }}
                        <br>
                        <span class="text-accent">{{ $subtitle }}</span>
                    </h2>
                </div>

                <p class="text-base sm:text-lg text-muted-foreground leading-relaxed">
                    {{ $description1 }}
                </p>

                <p class="text-base sm:text-lg text-muted-foreground leading-relaxed">
                    {{ $description2 }}
                </p>

                <div class="pt-6 sm:pt-8 border-t border-accent/30">
                    <blockquote class="text-xl sm:text-2xl font-heading italic text-foreground/90">
                        "{{ $quote }}"
                    </blockquote>
                    <p class="mt-3 sm:mt-4 text-accent font-medium">— {{ $quoteAuthor }}</p>
                </div>
            </div>

            <div class="relative animate-fade-in delay-300 mt-8 md:mt-0">
                <div class="relative overflow-hidden">
                    <img src="{{ $image }}" alt="Dr. Korayem at work" loading="lazy" decoding="async"
                        fetchpriority="low"
                        class="w-full h-[400px] sm:h-[500px] md:h-[600px] object-cover grayscale hover:grayscale-0 transition-all duration-700">
                    <div class="absolute inset-0 border-2 sm:border-4 border-accent/20 pointer-events-none"></div>
                </div>
            </div>
        </div>
    </div>
</section>
