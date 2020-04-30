<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function it_has_a_path()
    {
        $product = create('App\Product');

        $this->assertEquals('/products/' . $product->category->slug . '/' . $product->slug, $product->path());
    }
    /**
     * @test
     */
    public function it_belongs_to_a_category()
    {
        $product = make('App\Product');

        $this->assertInstanceOf('App\Category', $product->category);
    }
    /**
     * @test
     */
    public function it_has_images()
    {
        $product = create('App\Product');

        $image = create('App\Images', ['product_id' => $product->id]);

        $this->assertEquals(1, $product->images()->count());
    }
    /**
     * @test
     */
    public function an_image_belongs_to_a_product()
    {
        $image = make('App\Images');

        $this->assertInstanceOf('App\Product', $image->product);
    }
    /**
     * @test
     */
    public function it_belongs_to_a_value()
    {
        $product = create('App\Product');
        $value = create('App\AttributeValues');

        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $product->attributes);
    }
}
