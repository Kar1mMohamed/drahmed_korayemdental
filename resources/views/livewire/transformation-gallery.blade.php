<section id="transformations" class="py-16 md:py-20 lg:py-24 bg-black loading-fade-in">
    <div class="container mx-auto px-4 md:px-6 lg:px-8">
        <!-- Section Header -->
        <div class="text-center mb-12 md:mb-16 animate-fade-in-up delay-100">
            <div class="w-16 h-px bg-accent mx-auto mb-6"></div>
            <h2 class="text-4xl md:text-5xl lg:text-6xl font-heading font-bold mb-6">
                Real Transformations
                <br>
                <span class="text-accent">Real Confidence</span>
            </h2>
        </div>

        <!-- Loading State -->
        <div wire:loading.delay class="text-center py-8">
            <div class="inline-block animate-spin rounded-full h-12 w-12 border-t-2 border-b-2 border-accent"></div>
            <p class="mt-4 text-muted-foreground">Loading more transformations...</p>
        </div>

        <!-- Transformations Grid -->
        <div wire:loading.remove class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 max-w-7xl mx-auto">
            @forelse ($transformations as $index => $transformation)
                <div class="space-y-6 animate-fade-in-up delay-{{ min($index * 100, 500) }}" data-aos="fade-up"
                    data-aos-delay="{{ $index * 100 }}">
                    <div class="relative">
                        <!-- Image Comparison Slider -->
                        <img-comparison-slider class="slider-with-animated-handle">
                            <!-- Before Image -->
                            <img slot="first" src="{{ $transformation->before_image_url }}"
                                alt="Before transformation - {{ $transformation->client_name }}"
                                loading="{{ $index < 3 ? 'eager' : 'lazy' }}" decoding="async"
                                fetchpriority="{{ $index < 2 ? 'high' : 'low' }}" width="400" height="400"
                                class="w-full aspect-square object-cover object-center" />
                            <!-- After Image -->
                            <img slot="second" src="{{ $transformation->after_image_url }}"
                                alt="After transformation - {{ $transformation->client_name }}"
                                loading="{{ $index < 3 ? 'eager' : 'lazy' }}" decoding="async"
                                fetchpriority="{{ $index < 2 ? 'high' : 'low' }}" width="400" height="400"
                                class="w-full aspect-square object-cover object-center" />
                            <!-- Slider Handle -->
                            <div slot="handle" class="custom-handle">
                                <svg class="w-6 h-6 text-black" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 19l-7-7 7-7"></path>
                                </svg>
                                <svg class="w-6 h-6 text-black" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7"></path>
                                </svg>
                            </div>
                        </img-comparison-slider>

                        <!-- Labels -->
                        <div
                            class="absolute top-4 left-4 bg-black/80 px-4 py-2 text-sm font-semibold uppercase tracking-wider">
                            BEFORE
                        </div>
                        <div
                            class="absolute top-4 right-4 bg-black/80 px-4 py-2 text-sm font-semibold uppercase tracking-wider">
                            AFTER
                        </div>
                    </div>

                    <!-- Testimonial -->
                    {{-- Testimonial section removed as requested --}}
                </div>
            @empty
                <div class="col-span-full text-center py-12">
                    <p class="text-muted-foreground text-lg">No transformations available yet.</p>
                </div>
            @endforelse
        </div>

        <!-- Load More Button -->
        @if ($hasMore && !$showAll)
            <div class="text-center mt-12">
                <button wire:click="loadMore" class="btn-ghost-outline">
                    <span wire:loading.remove wire:target="loadMore">Load More Transformations</span>
                    <span wire:loading wire:target="loadMore">Loading...</span>
                </button>
            </div>
        @endif
    </div>
</section>
