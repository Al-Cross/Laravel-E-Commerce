<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Category;
use App\Product;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Product::class, function (Faker $faker) {
    $name = $faker->word;

    return [
        'category_id' => function () {
            return factory(Category::class)->create()->id;
        },
        'name' => $faker->word,
        'slug' => Str::slug($name.'_'.rand(1, 100)),
        'description' => $faker->sentence,
        'price' => rand(1, 1000),
        'sale_price' => rand(1, 500),
        'quantity' => 10
    ];
});
