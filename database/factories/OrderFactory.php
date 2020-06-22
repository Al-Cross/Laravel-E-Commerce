<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Order;
use Faker\Generator as Faker;
use Faker\Provider\Address;

$factory->define(Order::class, function (Faker $faker) {
    $name = $faker->name;
    $subtotal = 4.99;

    return [
        'user_id' => function () {
            return factory('App\User')->create()->id;
        },
        'name' => $name,
        'email' => $faker->email,
        'address' => $faker->streetAddress,
        'city' => $faker->city,
        'postalcode' => Address::postcode(),
        'country' => $faker->country,
        'phone' => $faker->phoneNumber,
        'name_on_card' => $name,
        'subtotal' => $subtotal,
        'tax' => $subtotal * 0.2,
        'total' => $subtotal * (1 + 0.2),
        'payment_gateway' => 'stripe',
        'shipped' => false,
        'error' => null,
        'quantity' => 1
    ];
});
