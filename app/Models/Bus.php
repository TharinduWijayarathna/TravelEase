<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bus extends Model
{
    use HasFactory;
    use SoftDeletes;

    const STATUS = [
        'ACTIVE' => 1,
        'INACTIVE' => 0
    ];

    protected $fillable = [
        'code',
        'license_plate',
        'driver_name',
        'name',
        'from',
        'to',
        'status',
        'description',
        'category_id',
    ];

    public function Category()
    {
        return $this->hasOne(Category::class, 'id', 'category_id');
    }

    public function BusImage()
    {
        return $this->hasMany(BusImage::class, 'bus_id', 'id');
    }
}
