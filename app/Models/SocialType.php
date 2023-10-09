<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SocialType extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'icon',
        'default-link',
        'prefix',
        'suffix'
    ];

    public function socials()
    {
        return $this->hasMany(Social::class);
    }
}
