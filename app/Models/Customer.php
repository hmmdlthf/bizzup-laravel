<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function emails()
    {
        return $this->hasMany(Email::class);
    }

    public function phones()
    {
        return $this->hasMany(Phone::class);
    }

    public function whatsapps()
    {
        return $this->hasMany(Whatsapp::class);
    }

    public function websites()
    {
        return $this->hasMany(Website::class);
    }

    public function socials()
    {
        return $this->hasMany(Social::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function other_images()
    {
        return $this->hasMany(OtherImage::class);
    }

    public function nfc_card()
    {
        return $this->hasOne(NfcCard::class);
    }
}
