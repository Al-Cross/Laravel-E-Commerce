<?php

namespace Tests\Feature;

use Tests\TestCase;
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
        $this->signInAdmin();

        $category = make(
            'App\Category',
            ['attribute' => [0 => 'some attribute', '1' => 'another attribute']]
        );

        $product = create('App\Product');
        $image = create('App\Images', ['product_id' => $product->id]);

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
}
