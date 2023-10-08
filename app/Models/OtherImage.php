<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OtherImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'image'
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
