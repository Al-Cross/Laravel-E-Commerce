<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CartTest extends TestCase
{
    use RefreshDatabase;
    /**
     * @test
     */
    public function a_user_can_add_a_product_to_the_cart()
    {
        $product = create('App\Product');

        $this->post(route('add-to-cart'), $product->toArray())
            ->assertSessionHas('flash', 'Item added to cart successfully.');
    }
    /**
     * @test
     */
    public function a_user_can_see_whats_in_their_cart()
    {
        $product = create('App\Product');

        $this->post(route('add-to-cart'), $product->toArray());

        $this->get(route('cart'))->assertSee($product->name);
    }
    /**
     * @test
     */
    public function a_user_may_remove_an_item_from_the_cart()
    {
        $product = create('App\Product');

        $this->post(route('add-to-cart'), $product->toArray());

        $this->get(route('cart'))->assertSee($product->name);

        $this->get(route('checkout.cart.remove', $product->id))
            ->assertSessionHas('flash', 'Item removed from cart successfully.');
    }
    /**
     * @test
     */
    public function a_user_may_clear_the_cart()
    {
        $product = create('App\Product');

        $this->post(route('add-to-cart'), $product->toArray());

        $this->get(route('cart'))->assertSee($product->name);
        $this->get(route('checkout.cart.clear'));
        $this->get(route('cart'))
            ->assertDontSee($product->name);
    }
}
