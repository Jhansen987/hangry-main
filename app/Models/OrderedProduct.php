<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderedProduct extends Model
{
    use HasFactory;
    public $timestamps = false; //disables created_at and updated_at columns whenever an item is added to cart
    protected $table = 'orderedproducts';
    protected $fillable = [
        'order_id',
        'product_name',
        'price',
        'product_image_path',
        'quantity',
        'customer_rating',
        'customer_message',
        'reviewed',
        'datereviewed',
        'user_id',
        'product_id'
    ];

    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function product(){
        return $this->belongsTo(Product::class,'product_id','id');
    }
}
