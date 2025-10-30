<?php

namespace App\Livewire;

use Livewire\Component;

class Hero extends Component
{
    public $title = 'Every Smile is a Story';

    public $subtitle = 'of Confidence.';

    public $description = 'Experience world-class smile design with Dr. Ahmed Korayem — where dentistry meets art.';

    public $heroImage;

    public function mount()
    {
        $this->heroImage = asset('assets/dr-korayem-original.png');
    }

    public function scrollToContact()
    {
        $this->dispatch('scroll-to-section', section: 'contact');
    }

    public function scrollToTransformations()
    {
        $this->dispatch('scroll-to-section', section: 'transformations');
    }

    public function render()
    {
        return view('livewire.hero');
    }
}
