<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Attribute;
use Faker\Generator as Faker;

$factory->define(Attribute::class, function (Faker $faker) {
    return [
        'category_id' => function () {
            return factory('App\Category')->create()->id;
        },
        'name' => $faker->word
    ];
});
