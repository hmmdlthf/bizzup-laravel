<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\NfcCard;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\URL;
use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\Label\Font\NotoSans;
use Endroid\QrCode\Writer\PngWriter;


class NfcCardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 500; $i++) { // You can generate as many NFC cards as needed
            $prefix = $this->generateAlphaPrefix();
            $uid = $this->generateUid($prefix);
            $url = env('APP_URL_ROOT') . 'open-profile.php?card-id=' . $uid;
            $qrcodePath = $this->generateQRCode($url, $uid);

            NfcCard::create([
                'prefix' => $prefix,
                'uid' => $uid,
                'url' => $url,
                'qrcode' => $qrcodePath,
            ]);
        }
    }

    private function generateUid($prefix)
    {
        // Generate a random 4-digit number
        $randomNumber = str_pad(mt_rand(0, 9999), 4, '0', STR_PAD_LEFT);

        // Combine the prefix and random number to create the UID
        $uid = $prefix . $randomNumber;

        return $uid;
    }

    private function generateAlphaPrefix()
    {
        // Generate a random uppercase letter followed by a random lowercase letter
        $prefix = chr(rand(65, 90)) . chr(rand(65, 90));

        return $prefix;
    }

    public function generateQRCode($url, $uid)
    {
        $result = Builder::create()
            ->writer(new PngWriter())
            ->writerOptions([])
            ->data($url)
            ->encoding(new Encoding('UTF-8'))
            ->size(300)
            ->margin(10)
            ->labelText($uid)
            ->labelFont(new NotoSans(20))
            ->validateResult(false)
            ->build();

        $qrcodePath = 'qrcodes/' . $uid . '.png'; // Generate a path for the QR code image
        $result->saveToFile(storage_path( 'app/public/' . $qrcodePath));
        return $qrcodePath;
    }
}
