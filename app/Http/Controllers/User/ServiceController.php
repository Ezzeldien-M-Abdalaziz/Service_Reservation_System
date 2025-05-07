<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ServiceController extends Controller
{
    public function services()
    {
        $services = Service::select('id', 'name' , 'description' , 'price' , 'rating')->paginate('6');

        return view('frontend.services' , compact('services'));
    }

    public function serviceDetails($id)
    {
        if (Auth::check()) {
            $service = Service::findOrFail($id);
            return view('frontend.service-details', compact('service'));
        } else {
            return redirect()->route('login');
        }
    }

    public function cancelReservation($id)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->status = 'cancelled';
        $reservation->save();

        return back()->with('success', 'Reservation cancelled.');
    }
}
