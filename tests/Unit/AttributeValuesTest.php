<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Support\Facades\Schema;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AttributeValuesTest extends TestCase
{
    use RefreshDatabase;
    /**
     * @test
     */
    public function it_has_expected_columns()
    {
        $this->assertTrue(
            Schema::hasColumns('attribute_values', [
            'id', 'attribute_id', 'value'
        ]),
            1
        );
    }
    /**
     * @test
     */
    public function it_belongs_to_many_products()
    {
        $value = create('App\AttributeValues');
        $product = create('App\Product');

        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $value->product);
    }
}
