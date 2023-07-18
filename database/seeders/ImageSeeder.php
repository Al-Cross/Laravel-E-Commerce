<?php

namespace Database\Seeders;

use App\Images;
use Illuminate\Database\Seeder;

class ImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Images::create([
            'product_id' => 1,
            'path' => 'images/1.jpg'
        ]);

        Images::create([
            'product_id' => 2,
            'path' => 'images/2.jpg'
        ]);

        Images::create([
            'product_id' => 3,
            'path' => 'images/3.jpg'
        ]);

        Images::create([
            'product_id' => 4,
            'path' => 'images/4.jpg'
        ]);

        Images::create([
            'product_id' => 5,
            'path' => 'images/12.jpg'
        ]);

        Images::create([
            'product_id' => 5,
            'path' => 'images/12-1.jpg'
        ]);

        Images::create([
            'product_id' => 5,
            'path' => 'images/12-2.jpg'
        ]);

        Images::create([
            'product_id' => 6,
            'path' => 'images/5.jpg'
        ]);

        Images::create([
            'product_id' => 7,
            'path' => 'images/apple-3.jpg'
        ]);

        Images::create([
            'product_id' => 7,
            'path' => 'images/laptop-2.jpg'
        ]);

        Images::create([
            'product_id' => 7,
            'path' => 'images/laptop-4.png'
        ]);

        Images::create([
            'product_id' => 7,
            'path' => 'images/laptop-1031224_640.jpg'
        ]);

        Images::create([
            'product_id' => 8,
            'path' => 'images/8.jpg'
        ]);

        Images::create([
            'product_id' => 9,
            'path' => 'images/9.jpg'
        ]);

        Images::create([
            'product_id' => 10,
            'path' => 'images/11.jpg'
        ]);

        Images::create([
            'product_id' => 11,
            'path' => 'images/camera-1.jpg'
        ]);

        Images::create([
            'product_id' => 11,
            'path' => 'images/camera-5.jpg'
        ]);

        Images::create([
            'product_id' => 12,
            'path' => 'images/camera-2.jpg'
        ]);

        Images::create([
            'product_id' => 13,
            'path' => 'images/camera-3.jpg'
        ]);

        Images::create([
            'product_id' => 13,
            'path' => 'images/camera-4.jpg'
        ]);

        Images::create([
            'product_id' => 14,
            'path' => 'images/headphones-4.jpg'
        ]);

        Images::create([
            'product_id' => 14,
            'path' => 'images/headphones-3.jpg'
        ]);

        Images::create([
            'product_id' => 15,
            'path' => 'images/headphone-2.jpg'
        ]);

        Images::create([
            'product_id' => 15,
            'path' => 'images/headphones-6.jpg'
        ]);

        Images::create([
            'product_id' => 15,
            'path' => 'images/headphone-5.jpg'
        ]);
    }
}
