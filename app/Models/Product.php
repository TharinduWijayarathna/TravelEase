<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;

    const STATUS = [
        'ACTIVE' => 1,
        'INACTIVE' => 0
    ];

    protected $fillable = [
        'code',
        'name',
        'price',
        'discount_price',
        'featured',
        'status',
        'quantity',
        'description',
        'category_id',
    ];

    public function Category()
    {
        return $this->hasOne(Category::class, 'id', 'category_id');
    }

    public function ProductImage()
    {
        return $this->hasMany(ProductImage::class, 'product_id', 'id');
    }

    public function WishList()
    {
        return $this->hasOne(WishList::class, 'product_id', 'id');
    }

    public function CartItem()
    {
        return $this->hasOne(CartItem::class, 'product_id', 'id');
    }
}
