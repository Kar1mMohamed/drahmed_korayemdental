<?php

namespace App\Livewire;

use Livewire\Component;

class WhatsappButton extends Component
{
    public $clinics = [];

    public $isOpen = false;

    public function mount()
    {
        $this->clinics = [
            [
                'name' => 'Alexandria',
                'phone' => '201000081871',
                'class' => 'alexandria-option',
            ],
            [
                'name' => 'Cairo',
                'phone' => '201116111135',
                'class' => 'cairo-option',
            ],
        ];
    }

    public function toggleMenu()
    {
        $this->isOpen = ! $this->isOpen;
    }

    public function render()
    {
        return view('livewire.whatsapp-button');
    }
}
