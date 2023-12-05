<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table = 'orders';
    protected $fillable = [
        'order_id',
        'firstname',
        'lastname',
        'username',
        'gender',
        'email',
        'contactnumber',
        'shipping_address',
        'payment_method',
        'order_status',
        'payment_status',
        'delivery_date',
        'subtotal',
        'shipping_fee',
        'grand_total'
    ];
}
