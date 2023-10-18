<?php

namespace Database\Seeders;

use App\Models\LinkType;
use Illuminate\Database\Seeder;

class LinkTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'name' => 'link',
                'code' => 'link',
            ],
            [
                'name' => 'qrcode',
                'code' => 'qrcode',
            ],
        ];

        // Using the DB facade to insert the data
        foreach ($data as $item) {
            LinkType::create([
                'name' => $item['name'],
                'code' => $item['code']
            ]);
        }
    }
}
