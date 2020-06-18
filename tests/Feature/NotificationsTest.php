<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class NotificationsTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function a_notification_is_prepared_when_the_available_quantity_is_low()
    {
        $admin = create('App\User');

        $this->signInAdmin($admin);

        $this->buyProduct(['stripeToken' => 'tok_visa'], 2);

        $this->assertCount(0, $admin->notifications);

        $this->buyProduct(['stripeToken' => 'tok_visa'], 7);

        $this->assertCount(1, $admin->fresh()->notifications);
    }
    /**
     * @test
     */
    public function a_notification_is_prepared_when_a_product_is_out_of_stock()
    {
        $admin = create('App\User');

        $this->signInAdmin($admin);

        $this->buyProduct(['stripeToken' => 'tok_visa'], 10);

        $this->assertCount(1, $admin->notifications);
    }
    /**
     * @test
     */
    public function the_administrator_can_mark_their_notifications_as_read()
    {
        $admin = create('App\User');

        $this->signInAdmin($admin);

        $this->buyProduct(['stripeToken' => 'tok_visa'], 10);

        $this->assertCount(1, $admin->unreadNotifications);

        $notificationId = $admin->unreadNotifications->first()->id;

        $this->delete(route('delete.notification', $notificationId));

        $this->assertCount(0, $admin->fresh()->unreadNotifications);
    }
    /**
     * @test
     */
    public function the_administrator_can_fetch_their_notifications()
    {
        $admin = create('App\User');

        $this->signInAdmin($admin);

        $this->buyProduct(['stripeToken' => 'tok_visa'], 10);

        $response = $this->getJson('/admin/notifications')->json();

        $this->assertCount(1, $response);
    }
}
