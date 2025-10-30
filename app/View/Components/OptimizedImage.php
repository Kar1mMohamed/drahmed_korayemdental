<?php

namespace App\View\Components;

use Illuminate\View\Component;

class OptimizedImage extends Component
{
    public $src;

    public $alt;

    public $class;

    public $loading;

    public $fetchpriority;

    public $width;

    public $height;

    public function __construct(
        $src,
        $alt = '',
        $class = '',
        $loading = 'lazy',
        $fetchpriority = 'auto',
        $width = null,
        $height = null
    ) {
        $this->src = $src;
        $this->alt = $alt;
        $this->class = $class;
        $this->loading = $loading;
        $this->fetchpriority = $fetchpriority;
        $this->width = $width;
        $this->height = $height;
    }

    public function render()
    {
        return view('components.optimized-image');
    }
}
