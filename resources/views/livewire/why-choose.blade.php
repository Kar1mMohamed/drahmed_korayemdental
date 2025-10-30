<section id="why-choose" class="py-12 sm:py-16 md:py-24 gradient-vignette loading-fade-in">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-8 sm:mb-12 md:mb-16 animate-fade-in-up delay-100">
            <div class="w-12 sm:w-16 h-px bg-accent mx-auto mb-4 sm:mb-6"></div>
            <h2 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-heading font-bold mb-4 sm:mb-6">
                Why Choose
                <br>
                <span class="text-accent"> Dr.Ahmed Korayem ?</span>
            </h2>
        </div>

        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8 lg:gap-12 mb-8 sm:mb-12 md:mb-16">
            @foreach ($reasons as $index => $reason)
                <div
                    class="text-center space-y-4 sm:space-y-6 p-6 sm:p-8 border border-accent/20 hover:border-accent/50 transition-all duration-300 animate-fade-in-up delay-{{ ($index + 2) * 100 }}">
                    <div
                        class="inline-flex items-center justify-center w-16 h-16 sm:w-20 sm:h-20 border-2 border-accent/50">
                        @if ($reason['icon'] === 'badge')
                            <svg class="w-8 h-8 sm:w-10 sm:h-10 text-accent" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z">
                                </path>
                            </svg>
                        @elseif($reason['icon'] === 'star')
                            <svg class="w-8 h-8 sm:w-10 sm:h-10 text-accent" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z">
                                </path>
                            </svg>
                        @else
                            <svg class="w-8 h-8 sm:w-10 sm:h-10 text-accent" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                                </path>
                            </svg>
                        @endif
                    </div>
                    <h3 class="text-xl sm:text-2xl font-heading font-semibold">{{ $reason['title'] }}</h3>
                    <p class="text-sm sm:text-base text-muted-foreground leading-relaxed">{{ $reason['description'] }}
                    </p>
                </div>
            @endforeach
        </div>

        <div class="max-w-3xl mx-auto text-center space-y-4 sm:space-y-6 animate-fade-in delay-500">
            <p class="text-base sm:text-lg text-muted-foreground leading-relaxed px-4">
                 Dr.Ahmed Korayem 's approach combines the latest technological advances with an artist's eye for
                aesthetics. Each smile design is customized to enhance your natural features while maintaining
                facial harmony and balance.
            </p>

            <blockquote
                class="text-xl sm:text-2xl font-heading italic text-foreground/90 pt-6 sm:pt-8 border-t border-accent/30 px-4">
                "Your smile is a reflection of your confidence. Let's design it with care."
            </blockquote>
        </div>
    </div>
</section>
