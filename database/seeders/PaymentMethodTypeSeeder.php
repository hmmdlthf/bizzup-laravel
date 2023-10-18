<?php

namespace Database\Seeders;

use App\Models\PaymentMethodType;
use Illuminate\Database\Seeder;

class PaymentMethodTypeSeeder extends Seeder
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
                'name' => 'google pay',
                'code' => 'gpay',
                'icon' => '/images/social-icons/google-pay.png'
            ],
            [
                'name' => 'phonepe',
                'code' => 'phonepe',
                'icon' => '/images/social-icons/phonepe.png'
            ],
        ];

        // Using the DB facade to insert the data
        foreach ($data as $item) {
            PaymentMethodType::create([
                'name' => $item['name'],
                'code' => $item['code'],
                'icon' => '/public' . $item['icon']
            ]);
        }
    }
}
