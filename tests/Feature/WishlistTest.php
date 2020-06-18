<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Exceptions\ItemInWishlistException;
use Illuminate\Foundation\Testing\RefreshDatabase;

class WishlistTest extends TestCase
{
    use RefreshDatabase;

    public function setUp() :void
    {
        parent::setUp();

        $this->user = create('App\User');
        $this->product = create('App\Product');
    }
    /**
     * @test
     */
    public function must_be_loggedin_to_see_the_wishlist()
    {
        $unauthenticated = create('App\User', ['id' => 12]);

        $this->get(route('wishlist', $unauthenticated->id))
            ->assertRedirect('/login');
    }
    /**
     * @test
     */
    public function authenticated_users_can_add_to_their_wishlist()
    {
        $this->actingAs($this->user);

        $response = $this->from($this->product->path())->post(
            route('wishlist.add', $this->user->id),
            ['productId' => $this->product->id]
        );

        $this->assertDatabaseHas('wishlists', [
                'user_id' => $this->user->id,
                'product_id' => $this->product->id
            ]);
    }
    /**
     * @test
     */
    public function authenticated_users_can_remove_items_from_wishlist()
    {
        $this->actingAs($this->user);

        $this->from($this->product->path())->post(
            route('wishlist.add', $this->user->id),
            ['productId' => $this->product->id]
        );

        $response = $this->get(
            route('wishlist.remove', [$this->user->id, $this->product->id])
        );

        $response->assertSessionHas(
            'flash',
            'Removed successfully from the wishlist.'
        );
        $this->assertDatabaseMissing(
            'wishlists',
            ['user_id' => $this->user->id, 'product_id' => $this->product->id]
        );
    }
}
