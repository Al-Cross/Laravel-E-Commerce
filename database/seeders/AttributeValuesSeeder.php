<?php

namespace Database\Seeders;

use App\AttributeValues;
use Illuminate\Database\Seeder;

class AttributeValuesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AttributeValues::create([
            'attribute_id' => 2,
            'value' => 'Tealc'
        ]);

        AttributeValues::create([
            'attribute_id' => 2,
            'value' => 'Dark Blue'
        ]);

        AttributeValues::create([
            'attribute_id' => 2,
            'value' => 'Light Brown'
        ]);

        AttributeValues::create([
            'attribute_id' => 2,
            'value' => 'Blue'
        ]);

        AttributeValues::create([
            'attribute_id' => 2,
            'value' => 'Ultra Dark Blue'
        ]);

        AttributeValues::create([
            'attribute_id' => 2,
            'value' => 'Grey'
        ]);

        AttributeValues::create([
            'attribute_id' => 1,
            'value' => 'M'
        ]);

        AttributeValues::create([
            'attribute_id' => 1,
            'value' => 'S'
        ]);

        AttributeValues::create([
            'attribute_id' => 1,
            'value' => 'XL'
        ]);

        AttributeValues::create([
            'attribute_id' => 3,
            'value' => '15"'
        ]);

        AttributeValues::create([
            'attribute_id' => 3,
            'value' => '13"'
        ]);

        AttributeValues::create([
            'attribute_id' => 4,
            'value' => 'intel iCore 7 2.3 GHz'
        ]);

        AttributeValues::create([
            'attribute_id' => 4,
            'value' => 'intel iCore 9 2.0 GHz'
        ]);

        AttributeValues::create([
            'attribute_id' => 5,
            'value' => '16 GB DDR5'
        ]);

        AttributeValues::create([
            'attribute_id' => 5,
            'value' => '8 GB DDR5'
        ]);

        AttributeValues::create([
            'attribute_id' => 6,
            'value' => 'nVidia G-Force 6 GB'
        ]);

        AttributeValues::create([
            'attribute_id' => 6,
            'value' => 'nVidia G-Force 4 GB'
        ]);

        AttributeValues::create([
            'attribute_id' => 1,
            'value' => '45'
        ]);

        AttributeValues::create([
            'attribute_id' => 7,
            'value' => '24,6 x 11,8 x 7,7 cm'
        ]);

        AttributeValues::create([
            'attribute_id' => 7,
            'value' => '34,6 x 21,8 x 12,7 cm'
        ]);

        AttributeValues::create([
            'attribute_id' => 7,
            'value' => '32,6 x 19,8 x 6,7 cm'
        ]);

        // 22
        AttributeValues::create([
            'attribute_id' => 8,
            'value' => 'White'
        ]);

        AttributeValues::create([
            'attribute_id' => 8,
            'value' => 'Black'
        ]);

        AttributeValues::create([
            'attribute_id' => 9,
            'value' => '17 hours'
        ]);

        AttributeValues::create([
            'attribute_id' => 9,
            'value' => '19 hours'
        ]);

        // 26
        AttributeValues::create([
            'attribute_id' => 10,
            'value' => '1080P/30fps'
        ]);

        AttributeValues::create([
            'attribute_id' => 10,
            'value' => '4K/30fps'
        ]);

        AttributeValues::create([
            'attribute_id' => 10,
            'value' => 'Native 4K/50fps'
        ]);

        // 29
        AttributeValues::create([
            'attribute_id' => 11,
            'value' => '170'
        ]);

        AttributeValues::create([
            'attribute_id' => 11,
            'value' => '120'
        ]);

        AttributeValues::create([
            'attribute_id' => 12,
            'value' => '2x1050mAh'
        ]);

        AttributeValues::create([
            'attribute_id' => 12,
            'value' => '2x1350mAh'
        ]);
    }
}
