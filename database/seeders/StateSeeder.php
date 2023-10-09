<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StateSeeder extends Seeder
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

        $states = array_column($csv, 1); // Extract state names from the CSV

        // Deduplicate state names and insert them into the 'states' table
        foreach (array_unique($states) as $stateName) {
            DB::table('states')->insert([
                'name' => $stateName,
                'country_id' => $this->getCountryId('India'), // Assuming 'India' has ID 1 in the 'countries' table
            ]);
        }
    }

    // Helper method to get the country_id based on country name
    private function getCountryId($countryName)
    {
        return DB::table('countries')->where('name', $countryName)->value('id');
    }
}
