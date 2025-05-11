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
        ->where('user_id', Auth::id())
        ->where(function ($query) {
        $query->where('date', '>', now()->toDateString())
              ->orWhere(function ($q) {
                  $q->where('date', now()->toDateString())
                    ->where('from', '>', now()->format('H:i:s'));
              });
        })
        ->where('status', '!=', 'cancelled')
        ->get();

        $pastReservations = Reservation::with('user', 'service')
        ->where('user_id', Auth::user()->id)
        ->where('date', '<', now()->format('Y-m-d'))
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
        if (!Auth::check()) {
            return redirect()->route('login.form')->with('error', 'Please login to view service details.');
        }
            $reservation = Reservation::findOrFail($id);

            $unavailableTimesByDate = Reservation::select('date', 'from', 'to')
            ->where('id', $id)
            ->where('status', '!=', 'cancelled')
            ->where('date', '>=', now()->format('Y-m-d'))
            ->get([ 'from', 'to'])
            ->groupBy('date');

        return view('frontend.reschedule' , compact('reservation' , 'unavailableTimesByDate'));
    }

    public function bookAgain($id){
        if (!Auth::check()) {
            return redirect()->route('login.form')->with('error', 'Please login to view service details.');
        }
            $reservation = Reservation::findOrFail($id);
            $service = $reservation->service;

            $unavailableTimesByDate = Reservation::select('date', 'from', 'to')
            ->where('status', '!=', 'cancelled')
            ->where('date', '>=', now()->format('Y-m-d'))
            ->get([ 'from', 'to'])
            ->groupBy('date');

        return view('frontend.book-service' , compact('reservation', 'service' , 'unavailableTimesByDate'));
    }
}
