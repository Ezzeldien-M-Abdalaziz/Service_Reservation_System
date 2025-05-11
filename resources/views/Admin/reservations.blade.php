@extends('admin.home')

@section('body')
    <main class="flex-1 p-6 overflow-y-auto">
        <h2 class="text-2xl font-semibold mb-6">Reservations</h2>

        <div class="bg-white rounded-md shadow-md p-4">
            <h3 class="text-lg font-semibold mb-4">All Reservations</h3>
            <div class="overflow-x-auto">
                <table class="min-w-full leading-normal shadow-md rounded-lg overflow-hidden">
                    <thead class="bg-gray-200 text-gray-700">
                        <tr>
                            <th class="px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold uppercase tracking-wider">
                                Reservation ID
                            </th>
                            <th class="px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold uppercase tracking-wider">
                                User
                            </th>
                            <th class="px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold uppercase tracking-wider">
                                Service
                            </th>
                            <th class="px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold uppercase tracking-wider">
                                Date
                            </th>
                            <th class="px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold uppercase tracking-wider">
                                Duration
                            </th>
                            <th class="px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold uppercase tracking-wider">
                                Status
                            </th>
                            <th class="px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold uppercase tracking-wider">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white">
                        @foreach($reservations as $reservation)
                        <tr>
                            <td class="px-5 py-5 border-b border-gray-200 text-sm">
                                {{$reservation->id}}
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 text-sm">
                                {{$reservation->user->name}}
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 text-sm">
                                {{$reservation->service->name}}
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 text-sm">
                                {{$reservation->date}}
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 text-sm">
                                {{$reservation->duration()}}
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 text-sm">
                                <span class="relative inline-block px-3 py-1 font-semibold text-green-900 leading-tight">
                                    @if($reservation->status == 'confirmed')
                                    <span class="absolute inset-0 bg-green-200 opacity-50 rounded-full"></span>
                                    @elseif($reservation->status == 'cancelled')
                                    <span class="absolute inset-0 bg-red-200 opacity-50 rounded-full"></span>
                                    @elseif($reservation->status == 'pending')
                                    <span class="absolute inset-0 bg-yellow-200 opacity-50 rounded-full"></span>
                                    @endif
                                    <span class="relative">{{$reservation->status}}</span>
                                </span>
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 text-sm">
                        <div class="relative inline-block text-left">
                            <form method="POST" action="{{ route('admin.reservations.status', $reservation->id) }}">
                                @csrf
                                @method('PATCH')
                                <button type="submit" name="status" value="confirmed"
                                    class="block px-4 py-2 text-sm text-black hover:bg-green-600 hover:text-white w-full text-left rounded-t-md">
                                    Confirm
                                </button>
                                <button type="submit" name="status" value="cancelled"
                                    class="block px-4 py-2 text-sm text-black hover:bg-red-600 hover:text-white w-full text-left rounded-b-md">
                                    Cancel
                                </button>
                            </form>
                        </div>
                    </td>

                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <!-- Pagination -->
       <!-- Laravel Pagination Links -->
        <div class="flex justify-center mt-12">
            {{ $reservations->links('vendor.pagination.tailwind') }}
        </div>
      </div>
    </main>


@endsection
