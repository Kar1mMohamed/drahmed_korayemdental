<?php

namespace App\Livewire;

use Livewire\Component;

class LazyImage extends Component
{
    public $src;

    public $alt;

    public $width = 400;

    public $height = 350;

    public $class = '';

    public $loading = 'lazy';

    public $placeholder;

    public function mount($src, $alt = '', $width = 400, $height = 350, $class = '', $loading = 'lazy')
    {
        $this->src = $src;
        $this->alt = $alt;
        $this->width = $width;
        $this->height = $height;
        $this->class = $class;
        $this->loading = $loading;
        $this->placeholder = \App\Helpers\ImageHelper::getPlaceholder();
    }

    public function render()
    {
        return view('livewire.lazy-image');
    }
}
