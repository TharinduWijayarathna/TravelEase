<?php

namespace App\Http\Controllers\PublicArea;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class BookingController extends Controller
{
    public function index()
    {
        return Inertia::render('PublicArea/Bookings/index');
    }

    public function userPage()
    {
        return Inertia::render('PublicArea/Bookings/userBookings');
    }
}
