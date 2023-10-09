<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $csvFile = base_path('data/india_cities_states_feb_2015.csv');
        $csv = array_map('str_getcsv', file($csvFile));
        array_shift($csv); // Remove the header row

        foreach ($csv as $row) {
            DB::table('cities')->insert([
                'name' => $row[0],
                'state_id' => $this->getStateId($row[1]), // You'll need a method to get state_id
            ]);
        }
    }

    // Helper method to get the state_id based on state name
    private function getStateId($stateName)
    {
        return DB::table('states')->where('name', $stateName)->value('id');
    }
}
