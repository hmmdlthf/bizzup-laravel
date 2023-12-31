<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Social extends Model
{
    use HasFactory;

    protected $fillable = [
        'value',
        'social_type_id'
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function social_type()
    {
        return $this->belongsTo(SocialType::class);
    }
}
