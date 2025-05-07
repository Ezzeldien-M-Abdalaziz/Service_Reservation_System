<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;

class ServiceController extends Controller
{
    public function services()
    {
        $services = Service::select('id', 'name' , 'description' , 'price' , 'rating')->paginate('6');

        return view('frontend.services' , compact('services'));
    }

    public function serviceDetails($id)
    {
        if (!Auth::check()) {
            return redirect()->route('login.form')->with('error', 'Please login to view service details.');
        }

            $service = Service::findOrFail($id);
            $upcomingReservations = Reservation::where('service_id', $service->id)
                ->where('from', '>', now())
                ->whereNot('status', 'cancelled')
                ->get();


                $userReservations = Reservation::where('user_id', Auth::user()->id)
                ->where('from', '>', now())
                ->get();


            return view('frontend.service-details', compact('service','upcomingReservations', 'userReservations'));

    }

    public function cancelReservation($id)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->status = 'cancelled';
        $reservation->save();

        return back()->with('success', 'Reservation cancelled.');
    }

    public function bookReservation(Request $request)
    {

        $request->validate([
            'service_id' => 'required|exists:services,id',
            'from' => 'required|date',
            'to' => 'required|date|after:from',
        ]);

        $service = Service::findOrFail($request->service_id);

        // Check if the service is available
        $reservations = Reservation::where('service_id', $service->id)
            ->where(function ($query) use ($request) {
                $query->whereBetween('from', [$request->from, $request->to])
                    ->orWhereBetween('to', [$request->from, $request->to]);
            })
            ->where('status', '!=', 'cancelled')
            ->exists();

        if ($reservations) {
            return back()->with('error', 'The service is not available for the selected time.');
        }

        Reservation::create([
            'user_id' => Auth::user()->id,
            'service_id' => $request->service_id,
            'from' => $request->from,
            'to' => $request->to,
            'status' => 'pending',
        ]);

        return redirect()->route('dashboard.index')->with('success', 'Reservation booked successfully.');
    }
}
