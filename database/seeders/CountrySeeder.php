<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Assuming your CSV file contains a single country (India)
        DB::table('countries')->insert([
            'name' => 'India'
        ]);
    }
}
