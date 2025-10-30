<?php

namespace Database\Seeders;

use App\Models\Transformation;
use Illuminate\Database\Seeder;

class TransformationSeeder extends Seeder
{
    public function run(): void
    {
        $transformations = [
            [
                'before_image' => 'assets/1/before-1.jpg',
                'after_image' => 'assets/1/after-1.jpg',
                'testimonial' => 'My confidence transformed along with my smile',
                'client_name' => 'Sarah M.',
                'is_active' => true,
                'order' => 1,
            ],
            [
                'before_image' => 'assets/2/before-2.jpg',
                'after_image' => 'assets/2/after-2.jpg',
                'testimonial' => 'A life-changing experience with incredible results',
                'client_name' => 'Michael T.',
                'is_active' => true,
                'order' => 2,
            ],
            [
                'before_image' => 'assets/3/before-3.jpg',
                'after_image' => 'assets/3/after-3.jpg',
                'testimonial' => 'The artistry and precision exceeded all expectations',
                'client_name' => 'Layla K.',
                'is_active' => true,
                'order' => 3,
            ],
            [
                'before_image' => 'assets/4/before-4.jpg',
                'after_image' => 'assets/4/after-4.jpg',
                'testimonial' => 'Professional care with stunning results',
                'client_name' => 'Ahmed S.',
                'is_active' => true,
                'order' => 4,
            ],
            [
                'before_image' => 'assets/5/before-5.jpg',
                'after_image' => 'assets/5/after-5.jpg',
                'testimonial' => 'My smile has never looked better',
                'client_name' => 'Nour H.',
                'is_active' => true,
                'order' => 5,
            ],
            [
                'before_image' => 'assets/6/before-6.jpg',
                'after_image' => 'assets/6/after-6.jpg',
                'testimonial' => 'Exceptional service and amazing transformation',
                'client_name' => 'Omar R.',
                'is_active' => true,
                'order' => 6,
            ],
        ];

        foreach ($transformations as $transformation) {
            Transformation::create($transformation);
        }
    }
}
