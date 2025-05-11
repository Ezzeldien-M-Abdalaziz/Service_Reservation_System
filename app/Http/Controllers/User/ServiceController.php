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
        $services = Service::select('id', 'name' , 'description' , 'price' , 'rating')
        ->where('available', 1)
        ->paginate('6');

        return view('frontend.services' , compact('services'));
    }

    public function bookAService($id)
    {
        if (!Auth::check()) {
            return redirect()->route('login.form')->with('error', 'Please login to view service details.');
        }

            $service = Service::findOrFail($id)->where('available', 1)->first();

            $unavailableTimesByDate = Reservation::select('date', 'from', 'to')
            ->where('status', '!=', 'cancelled')
            ->where('date', '>=', now()->format('Y-m-d'))
            ->get([ 'from', 'to'])
            ->groupBy('date');
            // return $unavailableTimesByDate;

            return view('frontend.book-service', compact('service' , 'unavailableTimesByDate'));

    }

    public function cancelReservation($id)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->status = 'cancelled';
        $reservation->save();

        return back()->with('success', 'Reservation cancelled.');
    }

    public function bookReservation(Request $request){
    $request->validate([
        'service_id' => 'required|exists:services,id',
        'date' => 'required|date',
        'from' => 'required|date_format:H:i',
        'to' => 'required|date_format:H:i|after:from',
    ],[
        'service_id.required' => 'Service ID is required',
        'service_id.exists' => 'Service not found',
        'date.required' => 'Date is required',
        'from.required' => 'Start time is required',
        'to.required' => 'End time is required',
        'to.after' => 'End time must be after start time',
    ]);

    $service = Service::findOrFail($request->service_id);

    //constaints
    if($request->date < now()->format('Y-m-d')){
        return back()->withErrors(['error' => 'You cannot book a service in the past.']);
    }

    if($request->date == now()->format('Y-m-d') && $request->from < now()->format('H:i')){
        return back()->withErrors(['error' => 'You cannot book a service in the past.']);
    }



    // Check if this service is already reserved at this time

    $isReserved = Reservation::where('service_id', $service->id)
        ->where('date', $request->date)
        ->where(function ($query) use ($request) {
            $query->where('from', '<', $request->to)
                  ->where('to', '>', $request->from);
        })
        ->where('status', '!=', 'cancelled')
        ->exists();

    if ($isReserved) {
        return back()->withErrors(['error' => 'This service is already booked at the selected time.']);
    }

    $otherReservations = Reservation::where('date', $request->date)
        ->where(function ($query) use ($request) {
            $query->where('from', '<', $request->to)
                ->where('to', '>', $request->from);
        })
        ->where('status', '!=', 'cancelled')
        ->exists();

    if ($otherReservations) {
        return back()->withErrors(['error' => 'Other service is already booked at the selected time.']);
    }

    // check user's existing reservation at that time
    $userConflict = Reservation::where('user_id', Auth::user()->id)
        ->where('date', $request->date)
        ->where(function ($query) use ($request) {
            $query->where('from', '<', $request->to)
                ->where('to', '>', $request->from);
        })
        ->exists();

    if ($userConflict) {
        return back()->withErrors(['error' => 'You already have a reservation at this time.']);
    }

    // Create reservation
    Reservation::create([
        'user_id'    => Auth::user()->id,
        'service_id' => $service->id,
        'date'       => $request->date,
        'from'       => $request->from,
        'to'         => $request->to,
        'status'     => 'pending',
    ]);

    return redirect()->route('services')->with('success', 'Reservation created successfully!');
    }


    public function updateReservation(Request $request, $id)
    {
        $request->validate([
            'date' => 'required|date',
            'from' => 'required|date_format:H:i',
            'to' => 'required|date_format:H:i|after:from',
        ]);

        $reservation = Reservation::findOrFail($id);

        //constaints
    if($request->date < now()->format('Y-m-d')){
        return back()->withErrors(['error' => 'You cannot book a service in the past.']);
    }

    if($request->from < now()->format('H:i')){
        return back()->withErrors(['error' => 'You cannot book a service in the past.']);
    }



    // Check if this service is already reserved at this time
    $isReserved = Reservation::where('id', $id)
        ->where('date', $request->date)
        ->where(function ($query) use ($request) {
            $query->whereBetween('from', [$request->from, $request->to])
                ->orWhereBetween('to', [$request->from, $request->to]);
        })
        ->where('status', '!=', 'cancelled')
        ->exists();

    if ($isReserved) {
        return back()->withErrors(['error' => 'This service is already booked at the selected time.']);
    }

    // check user's existing reservation at that time
    $userConflict = Reservation::where('user_id', Auth::user()->id)
        ->where('date', $request->date)
        ->where(function ($query) use ($request) {
            $query->whereBetween('from', [$request->from, $request->to])
                ->orWhereBetween('to', [$request->from, $request->to]);
        })
        ->exists();

    if ($userConflict) {
        return back()->withErrors(['error' => 'You already have a reservation at this time.']);
    }

        $reservation->update([
            'date' => $request->date,
            'from' => $request->from,
            'to' => $request->to,
        ]);

        return redirect()->route('dashboard.index')->with('success', 'Reservation updated successfully.');
    }

}
