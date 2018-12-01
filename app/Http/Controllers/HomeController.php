<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Booking;
use App\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::orderBy('created_at', 'DESC')->limit(5)->get();
        $bookings = Booking::orderBy('created_at', 'DESC')->limit(5)->get();
        return view('home')->with('bookings',$bookings)->with('users',$users);
    }
}
