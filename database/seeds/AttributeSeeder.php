<?php

use App\Attribute;
use Illuminate\Database\Seeder;

class AttributeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Attribute::create([
            'category_id' => 1,
            'name' => 'Size'
        ]);

        Attribute::create([
            'category_id' => 1,
            'name' => 'Color'
        ]);

        Attribute::create([
            'category_id' => 2,
            'name' => 'Display'
        ]);

        Attribute::create([
            'category_id' => 2,
            'name' => 'CPU'
        ]);

        Attribute::create([
            'category_id' => 2,
            'name' => 'RAM'
        ]);

        Attribute::create([
            'category_id' => 2,
            'name' => 'GPU'
        ]);

        Attribute::create([
            'category_id' => 3,
            'name' => 'Dimensions'
        ]);

        Attribute::create([
            'category_id' => 3,
            'name' => 'Color'
        ]);

        Attribute::create([
            'category_id' => 3,
            'name' => 'Battery Life'
        ]);

        Attribute::create([
            'category_id' => 4,
            'name' => 'Resolution'
        ]);

        Attribute::create([
            'category_id' => 4,
            'name' => 'Lens Angle'
        ]);

        Attribute::create([
            'category_id' => 4,
            'name' => 'Battery'
        ]);
    }
}
