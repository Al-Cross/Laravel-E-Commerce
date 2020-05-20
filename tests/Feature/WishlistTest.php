<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Exceptions\ItemInWishlistException;
use Illuminate\Foundation\Testing\RefreshDatabase;

class WishlistTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function unauthenticated_users_dont_have_a_wishlist()
    {
        $user = create('App\User');

        $this->get(route('wishlist', $user->id))
            ->assertRedirect('/login');
    }
    /**
     * @test
     */
    public function an_authenticated_user_can_visit_their_wishlist_page()
    {
        $this->withoutExceptionHandling();

        $user = create('App\User');
        $this->actingAs($user);

        $this->get(route('wishlist', $user->id))
            ->assertStatus(200);
    }
    /**
     * @test
     */
    public function authenticated_users_can_add_to_their_wishlist()
    {
        $user = create('App\User');
        $product = create('App\Product');

        $this->actingAs($user);

        $response = $this->from($product->path())->post(
            route('wishlist.add', $user->id),
            ['productId' => $product->id]
        );

        $this->assertDatabaseHas('wishlists', [
                'user_id' => $user->id,
                'product_id' => $product->id
            ]);
    }
    /**
     * @test
     */
    public function authenticated_users_can_remove_items_from_wishlist()
    {
        $user = create('App\User');
        $product = create('App\Product');

        $this->actingAs($user);

        $this->from($product->path())->post(
            route('wishlist.add', $user->id),
            ['productId' => $product->id]
        );
        $response = $this->get(route('wishlist.remove', [$user->id, $product->id]));

        $response->assertSessionHas(
            'message',
            'Removed successfully from the wishlist.'
        );
        $this->assertDatabaseMissing(
            'wishlists',
            ['user_id' => $user->id, 'product_id' => $product->id]
        );
    }
    /**
     * @test
     */
    public function a_product_may_not_be_added_twice_to_wishlist()
    {
        $user = create('App\User');
        $product = create('App\Product');

        $this->actingAs($user);

        $this->from($product->path())->post(
            route('wishlist.add', $user->id),
            ['productId' => $product->id]
        );

        $this->from($product->path())->post(
            route('wishlist.add', $user->id),
            $product->toArray()
        )->assertSessionHas('error', 'This item is already in your wishlist.');
    }
}
