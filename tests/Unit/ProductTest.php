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
}
