<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $upcomingReservations = Reservation::with('user', 'service')
        ->where('user_id', Auth::user()->id)
        ->where('date', '>', now())
        ->where('status', '!=', 'cancelled')
        ->get();

        $pastReservations = Reservation::with('user', 'service')
        ->where('user_id', Auth::user()->id)
        ->where('date', '<', now())
        ->where('status', '!=', 'cancelled')
        ->get();

        $cancelledReservations = Reservation::with('user', 'service')
        ->where('user_id', Auth::user()->id)
        ->where('status', 'cancelled')
        ->get();

        return view('frontend.dashboard' , compact('upcomingReservations' , 'pastReservations' , 'cancelledReservations'));
    }

    public function reschedule($id)
    {
        $reservation = Reservation::findOrFail($id);
        return view('frontend.reschedule' , compact('reservation'));
    }
}
