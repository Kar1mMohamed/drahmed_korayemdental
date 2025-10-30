<?php

namespace App\Helpers;

class ImageHelper
{
    /**
     * Get the before image path for a transformation
     */
    public static function beforeImage(int $index): string
    {
        $config = config('transformations.images');
        $folderNumber = $index + 1;

        return asset(
            $config['base_path'].'/'.$folderNumber.'/'.
            $config['before_prefix'].$folderNumber.
            $config['extension']
        );
    }

    /**
     * Get the after image path for a transformation
     */
    public static function afterImage(int $index): string
    {
        $config = config('transformations.images');
        $folderNumber = $index + 1;

        return asset(
            $config['base_path'].'/'.$folderNumber.'/'.
            $config['after_prefix'].$folderNumber.
            $config['extension']
        );
    }

    /**
     * Get transformation image pair
     */
    public static function transformationImages(int $index): array
    {
        return [
            'before' => self::beforeImage($index),
            'after' => self::afterImage($index),
        ];
    }

    /**
     * Get blur placeholder for lazy loading
     */
    public static function getPlaceholder(): string
    {
        return 'data:image/svg+xml,%3Csvg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 400 350"%3E%3Crect width="400" height="350" fill="%23222"/%3E%3C/svg%3E';
    }

    /**
     * Get responsive image srcset
     */
    public static function getResponsiveSrcset(string $imagePath): string
    {
        // For now return the original path
        // In production, you would generate multiple sizes
        return $imagePath;
    }
}
