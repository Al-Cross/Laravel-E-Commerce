<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SearchTest extends TestCase
{
    use RefreshDatabase;
    /**
     * @test
     */
    public function a_user_can_search_products()
    {
        $search = 'foobar';

        $productsNotInSearch = create('App\Product', [], 2);
        $products = create('App\Product', ['name' => "Name contains {$search} in it"], 2);

        $this->get("/search?query={$search}")
            ->assertSee($search)
            ->assertDontSee($productsNotInSearch);
    }
    /**
     * @test
     */
    public function administrator_can_search_users()
    {
        $this->signInAdmin();

        $search = 'John Doe';

        $usersNotInSearch = create('App\User', [], 2);
        $users = create('App\User', ['name' => "{$search}"]);

        $this->get(route("admin.dashboard.search", ["query" => "{$search}"]))
            ->assertSee($search)
            ->assertDontSee($usersNotInSearch);
    }
}
