<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ViewProductsTest extends TestCase
{
    use RefreshDatabase;

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
        $image = create('App\Images', ['product_id' => $this->product->id]);
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

        create('App\Images', ['product_id' => $productInCategory->id]);


        $this->get('/' . $category->slug)
            ->assertSee($productInCategory->name)
            ->assertDontSee($productNotInCategory->name);
    }
    /**
     // * @test
     */
    // public function a_user_can_view_the_product_attributes()
    // {
    //     $this->withoutExceptionHandling();

    //     $values = create('App\AttributeValues', [], 2);
    //     $image = create('App\Images', ['product_id' => $this->product->id]);

    //     $this->product->attributes()->attach($values);

    //     $this->get($this->product->path())
    //         ->assertSee($this->product->attributes[0]->value)
    //         ->assertSee($this->product->attributes[1]->value);
    // }
}
