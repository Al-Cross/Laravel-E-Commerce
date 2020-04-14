<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class Test extends TestCase
{
    use WithFaker, RefreshDatabase;

    public function setUp() :void
    {
        parent::setUp();

        $this->product = create('App\Product');
    }
    /**
     * @test
     */
    public function a_user_can_view_all_products()
    {
        // $this->withoutExceptionHandling();

        $this->get('/products')->assertSee($this->product->name)
        ->assertSee($this->product->price);
    }
    /**
     * @test
     */
    public function a_user_can_view_a_single_product()
    {
        $this->withoutExceptionHandling();

        $this->get($this->product->path())
            ->assertSee($this->product->name)
            ->assertSee($this->product->description);
    }
    /**
     * @test
     */
    public function a_user_can_filter_products_according_to_a_category()
    {
        $this->withoutExceptionHandling();

        $category = create('App\Category');
        $productNotInCategory = create('App\Product');
        $productInCategory = create('App\Product', ['category_id' => $category->id]);

        $this->get('/' . $category->slug)
            ->assertSee($productInCategory->name)
            ->assertDontSee($productNotInCategory->name);
    }
}
