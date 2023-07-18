<?php

namespace Database\Seeders;

use App\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
            'id' => 1,
            'name' => 'Fashion',
            'slug' => 'fashion'
        ]);

        Category::create([
            'id' => 2,
            'name' => 'Computers',
            'slug' => 'computers'
        ]);

        Category::create([
            'id' => 3,
            'name' => 'Headphones',
            'slug' => 'headphones'
        ]);

        Category::create([
            'id' => 4,
            'name' => 'Action Cameras',
            'slug' => 'action-cameras'
        ]);
    }
}
