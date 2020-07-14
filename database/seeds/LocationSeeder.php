<?php

use App\Location;
use Illuminate\Database\Seeder;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $locations = [
            ['name' => 'LOCATION 001'],
            ['name' => 'LOCATION 002'],
            ['name' => 'LOCATION 003'],
            ['name' => 'LOCATION 004'],
            ['name' => 'LOCATION 005'],
        ];

        foreach ($locations as $attributes) {
            $location = new Location($attributes);
            $location->save();
        }
    }
}
