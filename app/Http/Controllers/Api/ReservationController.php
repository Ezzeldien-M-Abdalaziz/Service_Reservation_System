<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function reservations()
    {
        $reservations = Reservation::with('service')->select('id', 'user_id', 'service_id', 'date', 'from', 'to', 'status')->paginate(10);
        return response()->json($reservations, 200);
    }

    public function reservation($id)
    {
        $reservation = Reservation::with('service')->findOrFail($id);
        return response()->json($reservation, 200);
    }

    public function changeStatus(Request $request, $id){
    $validatedData = $request->validate([
        'status' => 'required|string|in:pending,confirmed,cancelled',
    ],[
        'status.required' => 'Status is required',
        'status.string' => 'Status must be a string',
        'status.in' => 'Status must be one of the following: pending, confirmed, cancelled',
    ]);

    $reservation = Reservation::findOrFail($id);
    $service = $reservation->service;

    if (!$service) {
        return response()->json(['error' => 'Service not found for reservation'], 404);
    }

    $from = Carbon::parse($reservation->from);
    $to = Carbon::parse($reservation->to);
    $duration = $to->diffInMinutes($from);
    $service_price_in_min = $service->price / 60;
    $paid_price = abs($duration * $service_price_in_min);

    $updateData = [
        'status' => $validatedData['status'],
        'paid_price' => $validatedData['status'] === 'confirmed' ? $paid_price : null,
    ];

    $reservation->update($updateData);

    return response()->json($reservation, 200);
}

}
