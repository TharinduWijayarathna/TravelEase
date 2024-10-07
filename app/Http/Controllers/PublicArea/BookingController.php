<?php

namespace App\Http\Controllers\PublicArea;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Bus;
use App\Models\BusStop;
use Illuminate\Http\Request;
use Inertia\Inertia;

class BookingController extends Controller
{
    public function index($id)
    {
        $data['bus'] = Bus::find($id);
        $data['bus_stops'] = BusStop::where('bus_id', $id)->get();
        return Inertia::render('PublicArea/Bookings/index')->with($data);
    }

    public function userPage()
    {
        return Inertia::render('PublicArea/Bookings/userBookings');
    }

    public function store(Request $request)
    {
      return Booking::create($request->all());
    }
}
