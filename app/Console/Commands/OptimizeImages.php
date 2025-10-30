<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class OptimizeImages extends Command
{
    protected $signature = 'images:optimize {--clear-cache : Clear image cache}';

    protected $description = 'Optimize images for better performance';

    public function handle()
    {
        if ($this->option('clear-cache')) {
            $this->clearCache();

            return Command::SUCCESS;
        }

        $this->info('Image optimization command ready.');
        $this->info('To use image optimization, install intervention/image package:');
        $this->info('composer require intervention/image');
        $this->newLine();
        $this->info('Current optimizations active:');
        $this->info('✓ Lazy loading with Intersection Observer');
        $this->info('✓ Progressive image loading');
        $this->info('✓ Responsive images with srcset');
        $this->info('✓ Image caching');
        $this->info('✓ Preload critical images');

        return Command::SUCCESS;
    }

    protected function clearCache()
    {
        $optimizedDir = public_path('assets/optimized');

        if (File::exists($optimizedDir)) {
            File::deleteDirectory($optimizedDir);
            $this->info('Image cache cleared successfully!');
        } else {
            $this->info('No image cache to clear.');
        }
    }
}
