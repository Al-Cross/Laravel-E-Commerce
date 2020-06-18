<?php

use App\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'John Doe',
            'email' => 'johndoe@example.com',
            'email_verified_at' => null,
            'password' => bcrypt('password'),
            'address' => 'Mainstreet 24',
            'city' => 'Huntsville',
            'country' => 'United States'
        ]);
    }
}
