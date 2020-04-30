<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    /**
     * Sign in an administrator in the app.
     * @param  string $admin
     * @return Object
     */
    public function signInAdmin($admin = null)
    {
        $admin = $admin ?: create('App\User');

        config(['e-commerce.administrators' => [$admin->email]]);

        $this->actingAs($admin);

        return $this;
    }
}
