<?php

namespace App\Livewire;

use App\Models\Transformation;
use Livewire\Attributes\Lazy;
use Livewire\Component;

#[Lazy]
class TransformationGallery extends Component
{
    public $perPage = 6;

    public $showAll = false;

    public function loadMore()
    {
        $this->perPage += 3;
    }

    public function showAllTransformations()
    {
        $this->showAll = true;
    }

    public function placeholder()
    {
        return <<<'HTML'
        <section id="transformations" class="py-16 md:py-20 lg:py-24 bg-black">
            <div class="container mx-auto px-4 md:px-6 lg:px-8">
                <div class="text-center mb-12 md:mb-16 space-y-4">
                    <div class="h-1 bg-white/20 rounded-full w-16 mx-auto skeleton-shimmer"></div>
                    <div class="h-12 bg-white/10 rounded-lg w-2/3 mx-auto skeleton-shimmer"></div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 max-w-7xl mx-auto">
                    <div class="space-y-4">
                        <div class="bg-white/5 rounded-lg h-80 skeleton-shimmer border border-white/10"></div>
                    </div>
                    <div class="space-y-4 delay-100">
                        <div class="bg-white/5 rounded-lg h-80 skeleton-shimmer border border-white/10"></div>
                    </div>
                    <div class="space-y-4 delay-200">
                        <div class="bg-white/5 rounded-lg h-80 skeleton-shimmer border border-white/10"></div>
                    </div>
                    <div class="space-y-4 delay-300 hidden md:block">
                        <div class="bg-white/5 rounded-lg h-80 skeleton-shimmer border border-white/10"></div>
                    </div>
                    <div class="space-y-4 delay-400 hidden md:block">
                        <div class="bg-white/5 rounded-lg h-80 skeleton-shimmer border border-white/10"></div>
                    </div>
                    <div class="space-y-4 delay-500 hidden lg:block">
                        <div class="bg-white/5 rounded-lg h-80 skeleton-shimmer border border-white/10"></div>
                    </div>
                </div>
            </div>
        </section>
        HTML;
    }

    public function render()
    {
        $transformations = Transformation::active()
            ->ordered()
            ->when(! $this->showAll, fn ($query) => $query->take($this->perPage))
            ->get();

        $hasMore = ! $this->showAll && Transformation::active()->count() > $this->perPage;

        return view('livewire.transformation-gallery', [
            'transformations' => $transformations,
            'hasMore' => $hasMore,
        ]);
    }
}
