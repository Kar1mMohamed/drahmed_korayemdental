<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Transformations Data
    |--------------------------------------------------------------------------
    |
    | This file contains all the transformation testimonials displayed on
    | the website. Each transformation includes a patient name and quote.
    |
    */

    'items' => [
        [
            'name' => 'Sarah M.',
            'quote' => 'My confidence transformed along with my smile',
        ],
        [
            'name' => 'Michael T.',
            'quote' => 'A life-changing experience with incredible results',
        ],
        [
            'name' => 'Layla K.',
            'quote' => 'The artistry and precision exceeded all expectations',
        ],
        [
            'name' => 'Ahmed S.',
            'quote' => 'Professional care with stunning results',
        ],
        [
            'name' => 'Nour H.',
            'quote' => 'My smile has never looked better',
        ],
        [
            'name' => 'Omar R.',
            'quote' => 'Exceptional service and amazing transformation',
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Image Settings
    |--------------------------------------------------------------------------
    |
    | Configure the image paths and naming conventions for transformations.
    |
    */

    'images' => [
        'base_path' => 'assets',
        'before_prefix' => 'before-',
        'after_prefix' => 'after-',
        'extension' => '.jpg',
    ],
];
