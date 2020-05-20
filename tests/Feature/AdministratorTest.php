<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AdministratorTest extends TestCase
{
    use RefreshDatabase;

    public function setUp() :void
    {
        parent::setUp();

        $this->signInAdmin();

        $firstAttribute = create('App\Attribute', ['category_id' => 1]);
        $secondAttribute = create('App\Attribute', ['category_id' => 1]);

        $this->product = make(
            'App\Product',
            ['id' => 1,
            'attribute_id' => [1 => $firstAttribute->id, 2 => $secondAttribute->id],
            'attr_value' => [1 => 'some value', 2 => 'another value'],
            'select_value' => [0 => 'new 1', 1 => 'new 2'],
            'image' => [0 => $this->file1 = UploadedFile::fake()->image('avatar1.jpg'),
                        1 => $this->file2 = UploadedFile::fake()->image('avatar2.jpg')]]
        );

        $this->post('/admin/products', $this->product->toArray());
    }
    /**
     * @test
     */
    public function the_admin_can_access_the_dashboard()
    {
        $this->get(route('admin.dashboard.index'))
             ->assertStatus(200);
    }

    /** @test */
    public function a_non_administrator_cannot_access_the_administration_section()
    {
        $regularUser = create(User::class);

        $this->actingAs($regularUser)
             ->get('/admin')
             ->assertStatus(403);
    }
    /**
     * @test
     */
    public function an_administrator_can_create_a_product()
    {
        $this->assertDatabaseHas('attribute_values', ['value' => 'some value']);
        $this->assertDatabaseHas('product_attributes', ['attr_value_id' => 2]);

        Storage::disk('public')->assertExists('images/' . $this->file1->hashName());

        $this->get('/products')
            ->assertSee($this->product->name);
    }
    /**
     * @test
     */
    public function an_administrator_can_edit_a_product()
    {
        $product = create('App\Product');
        $firstAttribute = create('App\Attribute', ['category_id' => 1]);
        $secondAttribute = create('App\Attribute', ['category_id' => 1]);

        $this->patch('/admin/products/' . $product->slug . '/update', [
            'category_id' => $product->category_id,
            'name' => $product->name,
            'description' => 'Lorem ipsum text.',
            'quantity' => 5,
            'price' => 25.99,
            'attribute_id' => [1 => $firstAttribute->id, 2 => $secondAttribute->id],
            'attr_value' => [1 => 'some value', 2 => 'another value'],
            'select_value' => [0 => 'new value', 1 => 'new 2'],
        ]);

        tap($product->fresh(), function ($product) {
            $this->assertEquals(5, $product->quantity);
            $this->assertEquals(25.99, $product->price);
            $this->assertDatabaseHas('products', ['description' => 'Lorem ipsum text.']);
        });
    }
    /**
     * @test
     */
    public function an_administrator_may_delete_a_product()
    {
        Storage::disk('public')->assertExists('images/' . $this->file2->hashName());

        $this->delete(route('admin.product.delete', $this->product->id))
            ->assertSessionHas('message', 'Product successfully removed.');

        Storage::disk('public')->assertMissing('images/' . $this->file2->hashName());
        $this->assertDatabaseMissing('images', ['product_id' => $this->product->id]);
    }
    /**
     * @test
     */
    public function an_administrator_may_delete_a_user()
    {
        $this->withoutExceptionHandling();
        $user = create('App\User');

        $this->delete('/admin/users/' . $user->id)
            ->assertSessionHas(
                'message',
                'The user has been successfully removed from the site.'
            );

        $this->assertDatabaseMissing('users', ['name' => $user->name]);
    }
}
