@extends('admin.home')

@section('body')
 <main class="flex-1 p-6 overflow-y-auto">
        <h2 class="text-2xl font-semibold mb-6">Dashboard Overview</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-6">
            <div class="bg-white rounded-md shadow-md p-4 flex items-center justify-between">
                <div>
                    <h3 class="text-lg font-semibold text-gray-700">Total Revenue</h3>
                    <p class="text-2xl font-bold text-green-500">{{$total_revenue}} $</p>
                </div>
                <i data-lucide="bar-chart-4" class="h-8 w-8 text-green-500"></i>
            </div>

            <div class="bg-white rounded-md shadow-md p-4 flex items-center justify-between">
                <div>
                    <h3 class="text-lg font-semibold text-gray-700">Total reservations</h3>
                    <p class="text-2xl font-bold text-blue-500">{{$total_reservations}}</p>
                </div>
                <i data-lucide="list-checks" class="h-8 w-8 text-blue-500"></i>
            </div>

            <div class="bg-white rounded-md shadow-md p-4 flex items-center justify-between">
                <div>
                    <h3 class="text-lg font-semibold text-gray-700">Total Users</h3>
                    <p class="text-2xl font-bold text-purple-500">{{$total_users}}</p>
                </div>
                <i data-lucide="users" class="h-8 w-8 text-purple-500"></i>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <div class="bg-white rounded-md shadow-md p-4">
                <h3 class="text-lg font-semibold mb-4">Recent Reservations</h3>
                <div class="space-y-3">
                    @foreach($rescent_reservations as $reservation)
                    <div class="flex justify-between items-center border-b pb-2 last:border-0">
                        <div>
                            <div class="font-semibold">{{$reservation->user->name}}</div>
                            <div class="text-sm text-gray-500">{{$reservation->service->name}}</div>
                            <div class="text-xs text-gray-500">{{$reservation->date}}</div>
                        </div>
                        <div class="font-bold text-gray-900">${{$reservation->paid_price}}</div>
                    </div>
                    @endforeach
                </div>
            </div>

            <div class="bg-white rounded-md shadow-md p-4">
                <h3 class="text-lg font-semibold mb-4">Top Service Providers</h3>
                <div class="space-y-3">
                    @foreach ($top_services as $service)
                    <div class="flex justify-between items-center border-b pb-5 last:border-0">
                        <div>
                            <div class="font-semibold">{{$service->service->name}}</div>
                            <div class="text-sm text-gray-500">Reservations: {{$service->total}}</div>
                        </div>
                        <div class="font-bold text-yellow-500">Rating: {{$service->service->rating}}</div>
                    </div>
                    @endforeach

                </div>
            </div>
        </div>
    </main>
@endsection
