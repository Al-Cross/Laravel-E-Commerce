<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CheckoutTest extends TestCase
{
    use RefreshDatabase;
    /**
     * @test
     */
    public function a_user_can_visit_the_checkout_page()
    {
        $product = create('App\Product');

        $this->post(route('add-to-cart'), $product->toArray());

        $this->get(route('checkout'))
            ->assertSee($product->name);
    }
    /**
     * @test
     */
    public function non_logged_in_users_may_make_orders()
    {
        $this->withoutExceptionHandling();

        $product = create('App\Product');
        $order = make('App\Order', ['user_id' => null, 'stripeToken' => 'tok_visa']);

        $this->post(route('add-to-cart'), $product->toArray());
        $this->post('/checkout', $order->toArray());

        $this->assertDatabaseHas('orders', ['billing_name' => $order->name]);
    }
    /**
     * @test
     */
    public function logged_in_users_may_make_orders()
    {
        $user = create('App\User');

        $this->actingAs($user);

        $product = create('App\Product');
        $order = make('App\Order', [
            'user_id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'address' => $user->address,
            'city' => $user->city,
            'country' => $user->country,
            'name_on_card' => $user->name,
            'stripeToken' => 'tok_visa'
        ]);

        $this->post(route('add-to-cart'), $product->toArray());
        $this->post('/checkout', $order->toArray());

        $this->assertDatabaseHas(
            'orders',
            ['billing_email' => $user->email]
        );
    }
    /**
     * @test
     */
    public function the_available_quantity_decreases_after_an_order_is_made()
    {
        $product = create('App\Product');
        $order = make('App\Order', ['stripeToken' => 'tok_visa']);

        $this->assertDatabaseHas('products', ['quantity' => 10]);

        $this->post(route('add-to-cart'), [
            'id' => $product->id,
            'name' => $product->name,
            'price' => $product->price,
            'quantity' => 1
        ]);

        $this->post('/checkout', $order->toArray());

        $this->assertDatabaseHas(
            'products',
            ['quantity' => $product->quantity - $order->quantity]
        );
    }
}
