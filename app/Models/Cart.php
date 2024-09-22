<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cart extends Model
{
    use HasFactory;
    use SoftDeletes;

    const STATUS = [
        'ACTIVE' => 1,
        'INACTIVE' => 0
    ];
    
    protected $fillable = [
        'status',
        'created_by',
        'total',
        'sub_total',
        'discount',
        'customer_paid',
        'balance',
        'quantity',
        'customer_id',
        'customer_name',
        'customer_address',
        'customer_email',
        'customer_contact_number',
    ];

    public function Product()
    {
        return $this->hasMany(Product::class, 'id', 'product_id');
    }

    public function Customer()
    {
        return $this->hasOne(User::class, 'id', 'customer_id');
    }
}
