<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Customer;
use App\Models\Social;
use App\Models\Section;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $jsonPath = base_path('data/profile_data.json');
        // $json = file_get_contents($jsonPath);
        // $data = json_decode($json, true);

        // foreach ($data as $customerData) {
        //     $customer = Customer::create([
        //         'id' => $customerData['id'],
        //         'name' => $customerData['name'],
        //         'company_name' => $customerData['company_name'],
        //         'position' => $customerData['position'],
        //         'city' => $customerData['city'],
        //         'state' => $customerData['state'],
        //         'country' => $customerData['country'],
        //         'profile_pic' => $customerData['profile_pic'],
        //         'cover_pic' => $customerData['cover_pic'],
        //         'company_logo' => $customerData['company_logo'],
        //     ]);

        //     foreach ($customerData['socials'] as $socialData) {
        //         $customer->socials()->create([
        //             'name' => $socialData['name'],
        //             'value' => $socialData['value'],
        //         ]);
        //     }

        //     foreach ($customerData['sections'] as $sectionData) {
        //         $section = $customer->sections()->create([
        //             'title' => $sectionData['title'],
        //             'icon' => $sectionData['icon'],
        //             'type' => $sectionData['type'],
        //         ]);

        //         // You may need to handle nested data within sections here
        //     }
        // }
    }
}