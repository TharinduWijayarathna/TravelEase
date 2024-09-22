<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CartItem extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'unit_price',
        'unit_discount',
        'total_discount',
        'sub_total',
        'total',
        'quantity',
        'cart_id',
        'product_id',
    ];


    public function Product(){
        return $this->hasOne(Product::class, 'id', 'product_id');
    }

    public function Cart(){
        return $this->hasOne(Cart::class, 'id', 'cart_id');
    }
}
