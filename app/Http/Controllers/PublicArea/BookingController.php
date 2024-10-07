<?php

namespace App\Http\Controllers\PublicArea;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Bus;
use App\Models\BusStop;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Lahirulhr\PayHere\PayHere;

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

    public function pay($id)
    {
        $booking = Booking::find($id);
        $item_name = $booking->bus->name . "Booking"; // Use the dot operator for concatenation
        $data = [
            'first_name' => $booking->user->first_name,
            'last_name' => $booking->user->last_name,
            'email' => $booking->user->email,
            'phone' => $booking->user->contact_number,
            'address' => $booking->user->address,
            'city' => 'Colombo',
            'country' => 'Sri Lanka',
            'order_id' => $booking->id,
            'items' => $item_name,
            'currency' => 'LKR',
            'amount' => 4960.00,
        ];

        // creating checkout page & ridirect the user

        return PayHere::checkOut()
            ->data($data)
            ->successUrl('localhost:8000/booking/user/history')
            ->failUrl('localhost:8000/booking/user/history')
            ->renderView();
    }
}
