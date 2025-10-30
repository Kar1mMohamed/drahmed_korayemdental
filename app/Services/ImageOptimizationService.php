<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;

class ImageOptimizationService
{
    protected $cacheTime = 86400; // 24 hours

    /**
     * Get optimized image path with caching
     */
    public function getOptimizedImage(string $path, ?int $width = null, ?int $height = null, string $format = 'webp'): string
    {
        $cacheKey = "optimized_image_{$path}_{$width}_{$height}_{$format}";

        return Cache::remember($cacheKey, $this->cacheTime, function () use ($path, $width, $height, $format) {
            return $this->generateOptimizedImage($path, $width, $height, $format);
        });
    }

    /**
     * Generate optimized image
     */
    protected function generateOptimizedImage(string $path, ?int $width, ?int $height, string $format): string
    {
        $publicPath = public_path($path);

        if (! File::exists($publicPath)) {
            return asset($path);
        }

        // Create optimized directory if not exists
        $optimizedDir = public_path('assets/optimized');
        if (! File::exists($optimizedDir)) {
            File::makeDirectory($optimizedDir, 0755, true);
        }

        // Generate filename
        $pathInfo = pathinfo($path);
        $filename = $pathInfo['filename'];
        $optimizedFilename = "{$filename}_{$width}x{$height}.{$format}";
        $optimizedPath = "assets/optimized/{$optimizedFilename}";
        $optimizedPublicPath = public_path($optimizedPath);

        // Return if already exists
        if (File::exists($optimizedPublicPath)) {
            return asset($optimizedPath);
        }

        // For now, return original path
        // In production, you would use Intervention Image or similar
        return asset($path);
    }

    /**
     * Get blur placeholder data URL
     */
    public function getBlurPlaceholder(string $path): string
    {
        $cacheKey = "blur_placeholder_{$path}";

        return Cache::remember($cacheKey, $this->cacheTime, function () {
            // Return a simple gray placeholder
            return 'data:image/svg+xml,%3Csvg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 400 350"%3E%3Crect width="400" height="350" fill="%23333"/%3E%3C/svg%3E';
        });
    }

    /**
     * Clear image cache
     */
    public function clearCache(): void
    {
        Cache::flush();
    }
}
