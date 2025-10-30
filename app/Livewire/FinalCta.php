<?php

namespace App\Livewire;

use Livewire\Attributes\Lazy;
use Livewire\Component;

#[Lazy]
class FinalCta extends Component
{
    public $title = 'Your new smile';

    public $subtitle = 'starts here.';

    public $description = 'Book your consultation today and experience the art behind every smile.';

    public $buttonText = 'Start Your Smile Journey';

    public $doctorName = 'Dr. Ahmed Korayem';

    public $doctorTitle = 'First Sustaining Member, American Academy of Cosmetic Dentistry - Egypt';

    public function placeholder()
    {
        return <<<'HTML'
        <section class="py-12 sm:py-16 md:py-24 bg-black">
            <div class="container mx-auto px-4 sm:px-6 lg:px-8">
                <div class="max-w-4xl mx-auto text-center space-y-8">
                    <div class="space-y-4">
                        <div class="h-16 bg-white/10 rounded-lg w-3/4 mx-auto skeleton-shimmer"></div>
                        <div class="h-4 bg-white/10 rounded-full w-2/3 mx-auto skeleton-shimmer"></div>
                    </div>
                    <div class="h-14 bg-white/20 rounded-lg w-80 mx-auto skeleton-shimmer border-2 border-white/30"></div>
                    <div class="pt-8 border-t border-white/20 space-y-3">
                        <div class="h-5 bg-white/10 rounded-full w-48 mx-auto skeleton-shimmer"></div>
                        <div class="h-3 bg-white/10 rounded-full w-64 mx-auto skeleton-shimmer"></div>
                    </div>
                </div>
            </div>
        </section>
        HTML;
    }

    public function scrollToContact()
    {
        $this->dispatch('scroll-to-section', section: 'contact');
    }

    public function render()
    {
        return view('livewire.final-cta');
    }
}
