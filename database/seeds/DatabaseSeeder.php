<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('drinks')->insert([
            'name' => 'royal',
            'type_id' => 1,
            'alcohol_percent' => 37.5,
            'volume_unit_type_id' => 2,
            'volume_value' => 5,
            'user_id' => 1,
            'price' => 2899
        ]);
        DB::table('drinks')->insert([
            'name' => 'köbi',
            'type_id' => 2,
            'alcohol_percent' => 4.3,
            'volume_unit_type_id' => 2,
            'volume_value' => 5,
            'place_id' => 1,
            'price' => 219
        ]);
        DB::table('drink_types')->insert([
            'name' => 'vodka'
        ]);
        DB::table('drink_types')->insert([
            'name' => 'sör'
        ]);
        DB::table('unit_types')->insert([
            'name' => 'liter',
            'multiplier' => 10
        ]);
        DB::table('unit_types')->insert([
            'name' => 'deciliter',
            'multiplier' => 1
        ]);
        DB::table('users')->insert([
            'name' => Str::random(10),
            'email' => 'sarandi.abel@gmail.com',
            'password' => bcrypt('123123123'),
        ]);
        DB::table('places')->insert([
            "latitude" => 47.321604,
            "longitude" => 18.902978,
            "name"=> "KERÓ söröző"
        ]);
        DB::table('places')->insert([
            "latitude" => 47.399598,
            "longitude" => 18.929338,
            "name"=> "Kutyavári söröző"
        ]);
    }
}
