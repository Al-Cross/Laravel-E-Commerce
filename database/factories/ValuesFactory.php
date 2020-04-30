<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\AttributeValues;
use App\Attribute;
use Faker\Generator as Faker;

$factory->define(AttributeValues::class, function (Faker $faker) {
    return [
        'attribute_id' => function () {
            return factory(Attribute::class)->create();
        },
        'value' => $faker->word
    ];
});
