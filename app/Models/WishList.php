<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WishList extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'product_name',
        'status',
        'product_quantity',
        'product_price',
        'product_discount',
        'product_description',
        'product_image_id',
        'product_id',
        'customer_id',
        'customer_name',
        'customer_address',
        'customer_email',
        'customer_contact_number',
    ];

    public function ProductImage()
    {
        return $this->hasMany(ProductImage::class, 'id', 'product_image_id');
    }

    public function Product(){
        return $this->hasMany(Product::class, 'id', 'product_id');
    }

}
