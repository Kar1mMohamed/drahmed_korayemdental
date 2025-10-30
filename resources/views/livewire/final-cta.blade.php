<section class="py-32 gradient-hero text-center">
    <div class="container mx-auto px-6 max-w-4xl space-y-12 animate-fade-in-up">
        <h2 class="text-5xl md:text-6xl lg:text-7xl font-heading font-bold leading-tight">
            {{ $title }}
            <br>
            <span class="text-accent">{{ $subtitle }}</span>
        </h2>

        <p class="text-xl md:text-2xl text-muted-foreground max-w-2xl mx-auto font-light">
            {{ $description }}
        </p>

        <div class="pt-8">
            <button onclick="scrollToSection('contact')" class="btn-hero min-w-[320px]">
                {{ $buttonText }}
            </button>
        </div>

        <div class="pt-12 border-t border-accent/20 max-w-md mx-auto">
            <p class="font-heading text-3xl italic text-accent mb-2">{{ $doctorName }}</p>
            <p class="text-sm text-muted-foreground">
                {{ $doctorTitle }}
            </p>
        </div>
    </div>
</section>
