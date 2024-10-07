<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'bus_id',
        'user_id',
        'name',
        'email',
        'pickup',
        'dropoff',
        'date',
        'seats',
        'requests',
        'status',
    ];

    public function bus()
    {
        return $this->hasOne(Bus::class, 'id', 'bus_id');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
