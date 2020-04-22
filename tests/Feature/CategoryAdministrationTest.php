<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CategoryAdministrationTest extends TestCase
{
    use RefreshDatabase;
    /**
     * @test
     */
    public function an_administrator_can_access_the_category_administration_section()
    {
        $this->withoutExceptionHandling();

        $this->signInAdmin();

        $this->get(route('admin.dashboard.categories'))
            ->assertStatus(200);

        $this->get(route('admin.categories.create'))
            ->assertStatus(200);

        $this->get(route('admin.products.create'))
            ->assertStatus(200);
    }
    /**
     * @test
     */
    public function non_administrators_cannot_access_the_category_administration_section()
    {
        $regularUser = create('App\User');

        $this->actingAs($regularUser)
             ->get(route('admin.dashboard.categories'))
             ->assertStatus(403);

        $this->actingAs($regularUser)
             ->get(route('admin.categories.create'))
             ->assertStatus(403);

        $this->actingAs($regularUser)
             ->get(route('admin.products.create'))
             ->assertStatus(403);
    }
    /**
     * @test
     */
    public function an_administrator_can_create_a_category()
    {
        $this->withoutExceptionHandling();

        $this->signInAdmin();

        $category = make(
            'App\Category',
            ['attribute' => [0 => 'some attribute', '1' => 'another attribute']]
        );

        $response = $this->post('/admin/categories', $category->toArray());

        $this->get($response->headers->get('Location'))
            ->assertSee($category->name);

        $this->assertDatabaseHas('attributes', ['name' => 'some attribute']);
        $this->assertDatabaseHas('attributes', ['name' => 'another attribute']);
    }
    /**
     * @test
     */
    public function a_category_requires_a_name()
    {
        $this->signInAdmin();

        $category = make('App\Category', ['name' => null]);

        $this->post('/admin/categories', $category->toArray())
            ->assertSessionHasErrors('name');
    }
    /**
     * @test
     */
    public function an_administrator_can_create_a_product()
    {
        $this->withoutExceptionHandling();

        Storage::fake('local');

        $this->signInAdmin();

        $firstAttribute = create('App\Attribute', ['category_id' => 1]);
        $secondAttribute = create('App\Attribute', ['category_id' => 1]);

        $product = make(
            'App\Product',
            ['attribute_id' => [1 => $firstAttribute, 2 => $secondAttribute],
            'attr_value' => [1 => 'some value', 2 => 'another value'],
            'select_value' => [0 => 'new value', 1 => 2],
            'image' => [0 => $file1 = UploadedFile::fake()->image('avatar1.jpg'),
                        1 => $file2 = UploadedFile::fake()->image('avatar2.jpg')]]
        );

        $this->post('/admin/products', $product->toArray());

        $this->assertDatabaseHas('attribute_values', ['value' => 'some value']);
        Storage::disk('local')->assertExists('images/' . $file1->hashName())
            ->assertExists('images/' . $file2->hashName());

        $this->get('/products')
            ->assertSee($product->name);
    }
}
