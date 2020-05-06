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
        $this->withoutExceptionHandling();
        $search = 'foobar';

        $productsNotInSearch = create('App\Product', [], 2);
        $products = create('App\Product', ['name' => "Name contains {$search} in it"], 2);

        $this->get("/search?query={$search}")
            ->assertSee($search)
            ->assertDontSee($productsNotInSearch);
    }
}
