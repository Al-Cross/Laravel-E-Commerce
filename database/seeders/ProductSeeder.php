<?php

namespace Database\Seeders;

use App\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::create([
            'category_id' => 1,
            'name' => 'T-Shirt',
            'slug' => 't-shirt',
            'description' => '	Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
            'price' => 23.98,
            'sale_price' => 20.05,
            'quantity' => 10,
            'featured' => 0
        ]);

        Product::create([
            'category_id' => 1,
            'name' => 'Winter Jacket',
            'slug' => 'winter-jacket',
            'description' => '	Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
            'price' => 120.90,
            'sale_price' => 100.99,
            'quantity' => 10,
            'featured' => 1
        ]);

        Product::create([
            'category_id' => 1,
            'name' => 'Denim Shorts',
            'slug' => 'denim-shorts',
            'description' => '	Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
            'price' => 60.60,
            'sale_price' => null,
            'quantity' => 8,
            'featured' => 1
        ]);

        Product::create([
            'category_id' => 1,
            'name' => 'Backpack',
            'slug' => 'backpack',
            'description' => '	Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
            'price' => 35.84,
            'sale_price' => null,
            'quantity' => 8,
            'featured' => 0
        ]);

        Product::create([
            'category_id' => 1,
            'name' => 'High Sneackers',
            'slug' => 'high-sneackers',
            'description' => '	Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
            'price' => 50.00,
            'sale_price' => null,
            'quantity' => 15,
            'featured' => 0
        ]);

        Product::create([
            'category_id' => 2,
            'name' => 'MacBook Pro',
            'slug' => 'macbook-pro',
            'description' => '	Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
            'price' => 2869.00,
            'sale_price' => null,
            'quantity' => 8,
            'featured' => 1
        ]);

        Product::create([
            'category_id' => 2,
            'name' => 'Laptop',
            'slug' => 'laptop',
            'description' => '	Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
            'price' => 1869.00,
            'sale_price' => 1289.90,
            'quantity' => 10,
            'featured' => 0
        ]);

        Product::create([
            'category_id' => 3,
            'name' => 'Airpods',
            'slug' => 'airpods',
            'description' => '	Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
            'price' => 169.00,
            'sale_price' => null,
            'quantity' => 10,
            'featured' => 1
        ]);

        Product::create([
            'category_id' => 3,
            'name' => 'Headphones',
            'slug' => 'headphones',
            'description' => '	Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
            'price' => 75.00,
            'sale_price' => null,
            'quantity' => 8,
            'featured' => 0
        ]);

        Product::create([
            'category_id' => 4,
            'name' => 'Go Pro',
            'slug' => 'go-pro',
            'description' => '	Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
            'price' => 189.00,
            'sale_price' => null,
            'quantity' => 8,
            'featured' => 1
        ]);

        Product::create([
            'category_id' => 4,
            'name' => 'Go Pro CT7000',
            'slug' => 'go-pro-ct7000',
            'description' => '  Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
            'price' => 289.00,
            'sale_price' => null,
            'quantity' => 8,
            'featured' => 0
        ]);

        Product::create([
            'category_id' => 4,
            'name' => 'Go Pro CT9000',
            'slug' => 'go-pro-ct9000',
            'description' => '  Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
            'price' => 729.00,
            'sale_price' => null,
            'quantity' => 8,
            'featured' => 1
        ]);

        Product::create([
            'category_id' => 4,
            'name' => 'Go Pro CT8500',
            'slug' => 'go-pro-ct8500',
            'description' => '  Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
            'price' => 289.00,
            'sale_price' => 169.00,
            'quantity' => 8,
            'featured' => 0
        ]);

        Product::create([
            'category_id' => 3,
            'name' => 'Sehnheiser 230',
            'slug' => 'sehnheiser-230',
            'description' => '  Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
            'price' => 389.00,
            'sale_price' => null,
            'quantity' => 8,
            'featured' => 0
        ]);

        Product::create([
            'category_id' => 3,
            'name' => 'Beats Pro',
            'slug' => 'beats-pro',
            'description' => '  Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
            'price' => 245.00,
            'sale_price' => 112.89,
            'quantity' => 8,
            'featured' => 0
        ]);
    }
}
