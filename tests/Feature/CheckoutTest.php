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
        $this->buyProduct(['user_id' => null, 'stripeToken' => 'tok_visa']);

        $this->assertDatabaseHas('orders', ['payment_gateway' => 'stripe']);
    }
    /**
     * @test
     */
    public function logged_in_users_may_make_orders()
    {
        $user = create('App\User');

        $this->actingAs($user);

        $this->buyProduct([
            'user_id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'address' => $user->address,
            'city' => $user->city,
            'country' => $user->country,
            'name_on_card' => $user->name,
            'stripeToken' => 'tok_visa'
        ]);

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
        $this->buyProduct(['stripeToken' => 'tok_visa'], 4);

        $this->assertDatabaseHas('products', ['quantity' => 6]);
    }
}
