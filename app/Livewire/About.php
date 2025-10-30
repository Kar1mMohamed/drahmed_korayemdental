<?php

namespace App\Livewire;

use Livewire\Attributes\Lazy;
use Livewire\Component;

#[Lazy]
class About extends Component
{
    public $title = 'Meet the Artist';

    public $subtitle = 'Behind the Smile';

    public $description1 = 'With over 20 years of experience in aesthetic dentistry, Dr. Korayem has redefined the concept of cosmetic dental care.';

    public $description2 = 'As the first sustaining member of the American Academy of Cosmetic Dentistry in Egypt, he merges art, technology, and empathy—crafting smiles that inspire confidence.';

    public $quote = "It's not about fixing teeth — it's about designing confidence.";

    public $quoteAuthor = 'Dr. Ahmed Korayem';

    public $image;

    public function mount()
    {
        $this->image = asset('assets/dentist-working.jpg');
    }

    public function placeholder()
    {
        return <<<'HTML'
        <section class="py-12 sm:py-16 md:py-24 gradient-section">
            <div class="container mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid md:grid-cols-2 gap-8 sm:gap-12 items-center max-w-7xl mx-auto">
                    <div class="space-y-6">
                        <div class="h-1 bg-white/20 rounded-full w-16 skeleton-shimmer"></div>
                        <div class="h-12 bg-white/10 rounded-lg w-3/4 skeleton-shimmer"></div>
                        <div class="space-y-3">
                            <div class="h-4 bg-white/10 rounded-full skeleton-shimmer"></div>
                            <div class="h-4 bg-white/10 rounded-full w-5/6 skeleton-shimmer"></div>
                        </div>
                        <div class="space-y-3">
                            <div class="h-4 bg-white/10 rounded-full skeleton-shimmer"></div>
                            <div class="h-4 bg-white/10 rounded-full w-4/5 skeleton-shimmer"></div>
                        </div>
                        <div class="border-t border-white/20 pt-6 space-y-3">
                            <div class="h-6 bg-white/10 rounded-lg w-full skeleton-shimmer"></div>
                            <div class="h-4 bg-white/10 rounded-full w-32 skeleton-shimmer"></div>
                        </div>
                    </div>
                    <div class="delay-300">
                        <div class="bg-white/10 rounded-lg h-96 w-full skeleton-shimmer border-2 border-white/10"></div>
                    </div>
                </div>
            </div>
        </section>
        HTML;
    }

    public function render()
    {
        return view('livewire.about');
    }
}
