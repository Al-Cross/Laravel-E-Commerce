<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Images;
use App\Product;
use Faker\Generator as Faker;

$factory->define(Images::class, function (Faker $faker) {
    return [
        'product_id' => function () {
            return factory(Product::class)->create()->id;
        },
        'path' => 'images/path/to/image'
    ];
});
