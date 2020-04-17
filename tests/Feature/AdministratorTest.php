<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AdministratorTest extends TestCase
{
    use RefreshDatabase;
    /**
     * @test
     */
    public function the_admin_can_access_the_dashboard()
    {
        $this->withoutExceptionHandling();

        $administrator = create('App\User');
        config(['e-commerce.administrators' => [ $administrator->email ]]);

        $this->actingAs($administrator)
             ->get(route('admin.dashboard.index'))
             ->assertStatus(200);
    }

    /** @test */
    public function a_non_administrator_cannot_access_the_administration_section()
    {
        // $this->withoutExceptionHandling();

        $regularUser = factory(User::class)->create();

        $this->actingAs($regularUser)
             ->get('/admin')
             ->assertStatus(403);
    }
}
