<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use App\Models\Service;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function adminDashboard()
    {
        $total_revenue = Reservation::where('status', 'confirmed')->sum('paid_price');
        $total_reservations = Reservation::count();
        $total_users = User::count();
        $rescent_reservations = Reservation::with('user', 'service')
            ->where('status', 'confirmed')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();
        $top_services = Reservation::with('service')
            ->select('service_id', DB::raw('count(*) as total'))
            ->groupBy('service_id')
            ->orderBy('total', 'desc')
            ->take(5)
            ->get();

        return view('admin.dashboard' , compact('total_revenue', 'total_reservations', 'total_users', 'rescent_reservations', 'top_services'));
    }

    public function reservation()
    {
        $reservations = $reservations = Reservation::with('user', 'service')
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        return view('admin.reservations' , compact('reservations'));
    }

    public function users()
    {
        $users = User::paginate(10);
        return view('admin.users' , compact('users'));
    }

    public function services()
    {
        $services = Service::paginate(perPage: 10);
        return view('admin.services' , compact('services'));
    }


    public function updateStatus(Request $request, $id){
    $reservation = Reservation::findOrFail($id);

    $request->validate([
        'status' => 'required|in:confirmed,cancelled'
    ]);

    $reservation->status = $request->status;
    $reservation->save();

    return back()->with('success', 'Reservation status updated.');
}

    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return back()->with('success', 'User deleted successfully.');
    }

    public function ChangeAvailability(Request $request, $id)
    {
        $request->validate([
            'available' => 'required|boolean',
        ]);

        $service = Service::findOrFail($id);
        $service->available = $request->available;
        $service->save();

        return back()->with('success', 'Service availability updated.');
    }
}
