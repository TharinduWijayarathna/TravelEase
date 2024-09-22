<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory;
    use SoftDeletes;

    const IS_PAID = [
        'PAID' => 1,
        'NOT_PAID' => 0
    ];

    const IS_SHIPPED = [
        'SHIPPED' => 1,
        'NOT_SHIPPED' => 0
    ];
    
    protected $fillable = [
        'status',
        'code',
        'customer_code',
        'cart_code',
        'customer_name',
        'customer_email',
        'total',
        'is_paid',
        'is_shipped',
        'cart_id',
        'customer_id',
    ];

    public function Carts(){
        return $this->hasOne(Cart::class, 'id', 'cart_id');
    }
}
