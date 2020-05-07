<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CouponTest extends TestCase
{
    use RefreshDatabase;
    /**
     * @test
     */
    public function a_user_can_add_a_coupon_to_their_order()
    {
        $coupon = create('App\Coupon');

        $this->post('/coupon', $coupon->toArray())
            ->assertSessionHas('message', 'Coupon has been applied!');
    }
    /**
     * @test
     */
    public function a_user_can_remove_a_coupon_from_ther_order()
    {
        $coupon = create('App\Coupon');

        $this->delete('/coupon')
            ->assertSessionHas('message', 'The coupon has been removed.');
    }
    /**
     * @test
     */
    public function a_valid_coupon_code_must_be_provided()
    {
        $this->post('/coupon', ['code' => 'Invalid code'])
            ->assertSessionHas('error', 'Invalid coupon code.');
    }
    /**
     * @test
     */
    public function the_discount_changes_the_price_to_pay()
    {
        $product = create('App\Product');
        $order = make('App\Order', ['stripeToken' => 'tok_visa']);
        $coupon = create('App\Coupon');
        $tax = 0.2;
        $subtotal = \Cart::getSubtotal();
        $total = $subtotal * (1 + $tax);

        $this->post(route('add-to-cart'), [
            'id' => $product->id,
            'name' => $product->name,
            'price' => $product->price,
            'quantity' => 1
        ])->assertSee($total);

        $this->post('/coupon', $coupon->toArray());

        $discount = session()->get('coupon')['discount'];
        $newSubtotal = \Cart::getSubtotal() - $discount;
        $newTotal = $newSubtotal * (1 + $tax);

        $this->get('/checkout')->assertSee($newTotal);
    }
}
