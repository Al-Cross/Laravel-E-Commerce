<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function signInAdmin($admin = null)
    {
        $admin = $admin ?: create('App\User');

        config(['e-commerce.administrators' => [$admin->email]]);

        $this->actingAs($admin);

        return $this;
    }
}
