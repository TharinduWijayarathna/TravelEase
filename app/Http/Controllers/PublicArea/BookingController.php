<?php

namespace App\Http\Controllers\PublicArea;

use App\Http\Controllers\Controller;
use App\Models\Bus;
use Illuminate\Http\Request;
use Inertia\Inertia;

class BookingController extends Controller
{
    public function index($id)
    {
        $data['bus'] = Bus::with('Category', 'BusImage')->find($id);
        return Inertia::render('PublicArea/Bookings/index')->with($data);
    }

    public function userPage()
    {
        return Inertia::render('PublicArea/Bookings/userBookings');
    }
}
