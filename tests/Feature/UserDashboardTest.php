<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserDashboardTest extends TestCase
{
    use RefreshDatabase;
    /**
     * @test
     */
    public function a_user_can_visit_their_profile_page()
    {
        $user = create('App\User');
        $this->actingAs($user);

        $this->get(route('profile'))
            ->assertStatus(200)
            ->assertSee($user->name);
    }
    /**
     * @test
     */
    public function a_user_can_see_their_orders()
    {
        $user = create('App\User');
        $this->actingAs($user);

        $this->get(route('orders.index'))
            ->assertStatus(200)
            ->assertSee($user->orders->first());
    }
    /**
     * @test
     */
    public function unauthenticated_users_cannot_see_other_users_orders()
    {
        $user = create('App\User');

        $this->get(route('orders.index'))
            ->assertRedirect('/login');
    }
    /**
     * @test
     */
    public function unauthorized_users_cannot_edit_other_accounts()
    {
        $user = create('App\User');
        $this->actingAs($user);

        $this->get(route('edit.profile', create('App\User')->id))
            ->assertStatus(403);
    }
    /**
     * @test
     */
    public function a_user_can_edit_their_account()
    {
        $user = create('App\User');

        $this->actingAs($user);

        $this->get(route('profile'))
            ->assertStatus(200)
            ->assertSee($user->email);

        $this->patch(route('update.profile'), [
            'name' => $user->name,
            'email' => 'Changed@user.com',
            'address' => 'some new address',
            'city' => 'new city',
            'country' => $user->country
        ]);

        $this->assertDatabaseHas('users', [
            'email' => 'Changed@user.com',
            'address' => 'some new address',
            'city' => 'new city'
        ]);
    }
}
