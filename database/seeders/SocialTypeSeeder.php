<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class SocialTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $jsonPath = base_path('data/social_types_data.json');
        $json = file_get_contents($jsonPath);
        $socialTypes = json_decode($json, true);

        foreach ($socialTypes as $socialType) {
            // Copy the icon image to the storage directory
            // $iconPath = base_path('data' . $socialType['icon']);
            // $newIconPath = 'social-icons/' . basename($iconPath);
            // Storage::disk('public')->copy($iconPath, $newIconPath);

            DB::table('social_types')->insert([
                'name' => $socialType['name'],
                'icon' => '/public' . $socialType['icon'],
                'default-link' => $socialType['link'],
                'prefix' => $socialType['prefix'],
                'suffix' => $socialType['suffix'],
            ]);
        }
    }
}
