<?php

namespace App\Livewire;

use Livewire\Attributes\Lazy;
use Livewire\Component;

#[Lazy]
class WhyChoose extends Component
{
    public array $reasons = [];

    public function mount(): void
    {
        $this->reasons = [
            [
                'icon' => 'badge',
                'title' => '20+ Years of Experience',
                'description' => 'Two decades of mastering the art and science of cosmetic dentistry.',
            ],
            [
                'icon' => 'star',
                'title' => 'Precision & Aesthetic Excellence',
                'description' => 'Every detail matters in creating your perfect, natural-looking smile.',
            ],
            [
                'icon' => 'users',
                'title' => 'Trusted by Hundreds',
                'description' => 'Hundreds of confident smiles across Egypt and the Middle East.',
            ],
        ];
    }

    public function placeholder(): string
    {
        return <<<'HTML'
        <section class="py-12 sm:py-16 md:py-24 gradient-vignette">
            <div class="container mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-12 space-y-4">
                    <div class="h-1 bg-white/20 rounded-full w-16 mx-auto skeleton-shimmer"></div>
                    <div class="h-12 bg-white/10 rounded-lg w-1/2 mx-auto skeleton-shimmer"></div>
                </div>
                <div class="grid md:grid-cols-3 gap-8 max-w-6xl mx-auto">
                    <div class="space-y-4 text-center p-8 border border-white/10">
                        <div class="w-20 h-20 border-2 border-white/20 mx-auto skeleton-shimmer"></div>
                        <div class="h-6 bg-white/10 rounded-lg w-3/4 mx-auto skeleton-shimmer"></div>
                        <div class="space-y-2">
                            <div class="h-3 bg-white/10 rounded-full skeleton-shimmer"></div>
                            <div class="h-3 bg-white/10 rounded-full w-5/6 mx-auto skeleton-shimmer"></div>
                        </div>
                    </div>
                    <div class="space-y-4 text-center p-8 border border-white/10 delay-200">
                        <div class="w-20 h-20 border-2 border-white/20 mx-auto skeleton-shimmer"></div>
                        <div class="h-6 bg-white/10 rounded-lg w-3/4 mx-auto skeleton-shimmer"></div>
                        <div class="space-y-2">
                            <div class="h-3 bg-white/10 rounded-full skeleton-shimmer"></div>
                            <div class="h-3 bg-white/10 rounded-full w-5/6 mx-auto skeleton-shimmer"></div>
                        </div>
                    </div>
                    <div class="space-y-4 text-center p-8 border border-white/10 delay-400">
                        <div class="w-20 h-20 border-2 border-white/20 mx-auto skeleton-shimmer"></div>
                        <div class="h-6 bg-white/10 rounded-lg w-3/4 mx-auto skeleton-shimmer"></div>
                        <div class="space-y-2">
                            <div class="h-3 bg-white/10 rounded-full skeleton-shimmer"></div>
                            <div class="h-3 bg-white/10 rounded-full w-5/6 mx-auto skeleton-shimmer"></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        HTML;
    }

    public function render()
    {
        return view('livewire.why-choose');
    }
}
