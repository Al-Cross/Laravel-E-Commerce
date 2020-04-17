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
    public function an_administrator_can_access_the_channel_administration_section()
    {
        $this->withoutExceptionHandling();

        $this->signInAdmin();

        $this->get(route('admin.dashboard.categories'))
            ->assertStatus(200);

        $this->get(route('admin.dashboard.create'))
            ->assertStatus(200);
    }
    /**
     * @test
     */
    public function non_administrators_cannot_access_the_channel_administration_section()
    {
        $regularUser = create('App\User');

        $this->actingAs($regularUser)
             ->get(route('admin.dashboard.categories'))
             ->assertStatus(403);

        $this->actingAs($regularUser)
             ->get(route('admin.dashboard.create'))
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
        // dd($category);
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
