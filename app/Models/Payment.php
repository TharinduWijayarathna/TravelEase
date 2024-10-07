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

    protected $appends = [
        'customer',
        'booking',
        'travel_provider',
    ];

    public function getCustomerAttribute()
    {
        return $this->customer->name ?? '';
    }

    public function getBookingAttribute()
    {
        return $this->booking->name ?? '';
    }

    public function getTravelProviderAttribute()
    {
        return $this->travelProvider->name ?? '';
    }

    public function customer()
    {
        return $this->hasOne(User::class, 'id', 'customer_id');
    }

    public function booking()
    {
        return $this->hasOne(Booking::class, 'id', 'booking_id');
    }

    public function travelProvider()
    {
        return $this->hasOne(User::class, 'id', 'travel_provider_id');
    }
}
