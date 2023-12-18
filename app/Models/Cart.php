<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $table = 'cart';
    public $timestamps = false; //disables created_at and updated_at columns whenever an item is added to cart

    protected $fillable = [
        'username',
        'product_id',
        'quantity'
    ];

    public function product(){
        return $this->belongsTo(Product::class,'product_id','id');
    }
}
