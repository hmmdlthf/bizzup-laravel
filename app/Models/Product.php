<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'des',
        'image',
        'price',
        'discount-price'
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
