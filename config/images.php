<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Image Optimization Settings
    |--------------------------------------------------------------------------
    |
    | Configure image optimization behavior for the application.
    |
    */

    'optimization' => [
        'enabled' => env('IMAGE_OPTIMIZATION_ENABLED', true),
        'cache_time' => env('IMAGE_CACHE_TIME', 2592000), // 30 days
        'quality' => env('IMAGE_QUALITY', 80),
    ],

    'lazy_loading' => [
        'enabled' => true,
        'threshold' => 0.01, // Start loading when 1% visible
        'root_margin' => '50px', // Start loading 50px before viewport
        'eager_count' => 3, // Number of images to load eagerly
    ],

    'formats' => [
        'webp' => [
            'enabled' => env('WEBP_ENABLED', true),
            'quality' => 80,
        ],
        'jpeg' => [
            'quality' => 85,
        ],
        'png' => [
            'compression' => 9,
        ],
    ],

    'responsive' => [
        'enabled' => env('RESPONSIVE_IMAGES_ENABLED', true),
        'breakpoints' => [
            'sm' => 400,
            'md' => 800,
            'lg' => 1200,
            'xl' => 1600,
        ],
    ],

    'cdn' => [
        'enabled' => env('IMAGE_CDN_ENABLED', false),
        'url' => env('IMAGE_CDN_URL', ''),
    ],

    'preload' => [
        'hero_image' => true,
        'critical_images' => [
            'assets/dr-korayem-original.png',
        ],
    ],
];
