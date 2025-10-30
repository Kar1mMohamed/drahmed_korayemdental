<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;

class ClearImageCache extends Command
{
    protected $signature = 'images:clear-cache';

    protected $description = 'Clear all image optimization cache';

    public function handle()
    {
        Cache::flush();
        $this->info('Image cache cleared successfully!');

        return 0;
    }
}
