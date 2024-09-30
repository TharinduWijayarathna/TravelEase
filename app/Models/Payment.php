<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'customer_id',
        'booking_id',
        'travel_provider_id',
        'price',
        'payment_method',
        'payment_status',
        'payment_reference',
        'payment_date',
    ];
}
