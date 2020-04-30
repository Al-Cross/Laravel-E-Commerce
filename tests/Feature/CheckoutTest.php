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
        $product = create('App\Product');
        $order = make('App\Order', ['stripeToken' => 'tok_visa']);

        $this->post(route('add-to-cart'), $product->toArray());
        $this->post('/checkout', $order->toArray());

        $this->assertDatabaseHas('orders', ['billing_email' => $order->email]);
    }
}
