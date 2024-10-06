<?php

namespace App\Http\Controllers\PublicArea;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Lahirulhr\PayHere\PayHere;

class PaymentController extends Controller
{
    public function index()
    {
        // in your controller

        $data = [
            'first_name' => 'Lahiru',
            'last_name' => 'Tharaka',
            'email' => 'lahirulhr@gmail.com',
            'phone' => '+94761234567',
            'address' => 'Main Rd',
            'city' => 'Anuradhapura',
            'country' => 'Sri lanka',
            'order_id' => '45552525005',
            'items' => 'Smart band MI 4 - BLACK',
            'currency' => 'LKR',
            'amount' => 4960.00,
        ];

        // creating checkout page & ridirect the user

        return PayHere::checkOut()
            ->data($data)
            ->successUrl('www.visanduma.com/success')
            ->failUrl('www.visanduma.com/fail')
            ->renderView();
    }
}
