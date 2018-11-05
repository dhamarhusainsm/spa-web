<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Booking;

class bookingController extends Controller
{
    //
    public function store(Request $request)
    {
        $booking = new Booking;
        $booking->user_id = $request->user_id;
        $booking->order = $request->order;
        $booking->date = $request->date;
        $booking->save();
        return response()->json([
            'success' => 'true'
        ], 200);
    }
}
