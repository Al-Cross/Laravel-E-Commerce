<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Coupon;
use Faker\Generator as Faker;

$factory->define(Coupon::class, function (Faker $faker) {
    return [
        'code' => 'ABC123',
        'type' => 'fixed',
        'value' => 5
    ];
});

$factory->state(Coupon::class, 'percent', [
    'code' => 'XYZ789',
    'type' => 'percent',
    'percent_off' => 10
]);
