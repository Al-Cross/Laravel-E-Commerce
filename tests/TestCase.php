<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    /**
     * Sign in an administrator in the app.
     *
     * @param  string $admin
     * @return Object
     */
    public function signInAdmin($admin = null)
    {
        $admin = $admin ?: create('App\User');

        config(['e-commerce.administrators' => [$admin->email]]);

        $this->actingAs($admin);

        return $this;
    }

    /**
     * Simulate the process of order and checkout.
     *
     * @param array   $options  The order details
     * @param integer $quantity The ordered quantity
     */
    public function buyProduct($options = [], $quantity = null)
    {
        $product = create('App\Product');
        $order = make('App\Order', $options);

        $this->post(route('add-to-cart'), [
            'id' => $product->id,
            'name' => $product->name,
            'price' => $product->price,
            'quantity' => $quantity ?: 1
        ]);

        $this->post('/checkout', $order->toArray());
    }
}
