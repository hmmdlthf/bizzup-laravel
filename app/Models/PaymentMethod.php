<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    use HasFactory;

    protected $fillable = [
        'qrcode_image',
        'url',
        'pay_number',
        'account_holder_name',
        'customer_id',
        'payment_method_type_id'
    ];
}
