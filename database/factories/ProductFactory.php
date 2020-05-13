<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use App\Category;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    $name = $faker->word;
    return [
        'category_id' => function () {
            return factory(Category::class)->create()->id;
        },
        'name' => $faker->word,
        'slug' => Str::slug($name . '_' . rand(1, 100)),
        'description' => $faker->sentence,
        'price' => rand(1, 1000),
        'quantity' => 10
    ];
});
