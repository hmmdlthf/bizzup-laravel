<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Customer extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'username',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

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

    public function payment_methods()
    {
        return $this->hasMany(PaymentMethod::class);
    }
}
