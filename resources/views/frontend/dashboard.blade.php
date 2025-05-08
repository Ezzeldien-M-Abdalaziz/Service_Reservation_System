@extends('layouts.frontend.app')
@section('body')
    <main class="flex-grow container mx-auto px-4 py-8">
      <div class="max-w-4xl mx-auto">
        <h1 class="text-3xl font-bold mb-2">Your Dashboard</h1>
        <p class="text-gray-600 mb-8">
          Welcome back, {{ Auth::user()->name }}! Manage your reservations here.
        </p>

        <!-- Tabs -->
        <div class="mb-6 border-b border-gray-200">
          <ul class="flex flex-wrap -mb-px">
            <li class="mr-2">
              <button
                class="inline-block py-2 px-4 text-brand-600 border-b-2 border-brand-500 font-medium"
                onclick="switchTab('upcoming')"
                id="upcoming-tab"
              >
                Upcoming Reservations
              </button>
            </li>
            <li class="mr-2">
              <button
                class="inline-block py-2 px-4 text-gray-500 font-medium hover:text-brand-600 hover:border-brand-300"
                onclick="switchTab('past')"
                id="past-tab"
              >
                Past Reservations
              </button>

            </li>

            <li class="mr-2">
                <button
                  class="inline-block py-2 px-4 text-gray-500 font-medium hover:text-brand-600 hover:border-brand-300"
                  onclick="switchTab('cancelled')"
                  id="cancelled-tab"
                >
                  Cancelled Reservations
                </button>
              </li>
          </ul>
        </div>

        <!-- Upcoming Reservations Tab Content -->
        <div id="upcoming-content" class="tab-content">
          <!-- Reservation Card -->
          @foreach($upcomingReservations as $reservation)
          <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 mb-4">
            <div class="flex justify-between items-start">
              <div>
                <h3 class="text-lg font-semibold mb-1">{{ $reservation->service->name }}</h3>
                <div class="flex items-center text-gray-500 text-sm mb-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    <p class="mx-1 flex-1">{{ $reservation->date }}</p>
                    <span>({{ $reservation->from }}</span>
                    <span class="mx-1">to</span>
                    <span>{{ $reservation->to }})</span>
                  </div>

                <div class="inline-block px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                    {{ $reservation->status }}
                </div>
              </div>
              <div class="text-right">
                <span class="block text-lg font-semibold text-brand-600">${{ $reservation->paid_price ? $reservation->paid_price : "N/A"}}</span>
                <span class="block text-sm text-gray-500">{{$reservation->duration()}} min</span>
              </div>
            </div>
            <div class="mt-4 pt-4 border-t border-gray-100 flex justify-end space-x-2">
              <a href="{{route('dashboard.reschedule', $reservation->id)}}" class="px-3 py-1 text-sm border border-gray-300 rounded hover:bg-gray-50">
                Reschedule
              </a>

              <form action="{{ route('reservation.cancel', $reservation->id) }}" method="POST" class="inline">
                @csrf
              <button type="submit" class="px-3 py-1 text-sm border border-red-300 text-red-700 rounded hover:bg-red-50">
                Cancel
              </button>
            </form>
            </div>
          </div>
            @endforeach
        </div>

        <!-- Past Reservations Tab Content (Hidden by default) -->
        <div id="past-content" class="tab-content hidden">
          <!-- Past Reservation Card -->

          @foreach($pastReservations as $reservation)
          <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 mb-4 opacity-75">
            <div class="flex justify-between items-start">
              <div>
                <h3 class="text-lg font-semibold mb-1"></h3>
                <p class="text-gray-600 mb-1">{{ $reservation->service->name }}</p>
                <div class="flex items-center text-gray-500 text-sm mb-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    <p class="mx-1 flex-1">{{ $reservation->date }}</p>
                    <span>({{ $reservation->from }}</span>
                    <span class="mx-1">to</span>
                    <span>{{ $reservation->to }})</span>
                  </div>
                <div class="inline-block px-2 py-1 text-xs font-semibold rounded-full bg-gray-100 text-gray-800">
                    {{ $reservation->status }}
                </div>
              </div>
              <div class="text-right">
                <span class="block text-lg font-semibold text-gray-600">${{ $reservation->paid_price ? $reservation->paid_price : "N/A"}}</span>
                <span class="block text-sm text-gray-500">{{ $reservation->duration() }} min</span>
              </div>
            </div>
            <div class="mt-4 pt-4 border-t border-gray-100 flex justify-end">
              <button class="px-3 py-1 text-sm border border-brand-300 text-brand-600 rounded hover:bg-brand-50">
                Book Again
              </button>
            </div>
          </div>
            @endforeach
        </div>

        <!-- cancelled Reservations Tab Content (Hidden by default) -->
        <div id="cancelled-content" class="tab-content hidden">
            <!-- cancelled Reservation Card -->

            @foreach($cancelledReservations as $reservation)
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 mb-4 opacity-75">
              <div class="flex justify-between items-start">
                <div>
                  <h3 class="text-lg font-semibold mb-1"></h3>
                  <p class="text-gray-600 mb-1">{{ $reservation->service->name }}</p>
                  <div class="flex items-center text-gray-500 text-sm mb-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    <p class="mx-1 flex-1">{{ $reservation->date }}</p>
                    <span>({{ $reservation->from }}</span>
                    <span class="mx-1">to</span>
                    <span>{{ $reservation->to }})</span>
                  </div>
                  <div class="inline-block px-2 py-1 text-xs font-semibold rounded-full bg-gray-100 text-gray-800">
                      {{ $reservation->status }}
                  </div>
                </div>
                <div class="text-right">
                  <span class="block text-lg font-semibold text-gray-600">${{ $reservation->paid_price ? $reservation->paid_price : "N/A"}}</span>
                  <span class="block text-sm text-gray-500">{{ $reservation->duration() }} min</span>
                </div>
              </div>
              <div class="mt-4 pt-4 border-t border-gray-100 flex justify-end">
                <button class="px-3 py-1 text-sm border border-brand-300 text-brand-600 rounded hover:bg-brand-50">
                  Book Again
                </button>
              </div>
            </div>
              @endforeach
          </div>

      </div>
    </main>

    <script>
      // Set current year in footer
      document.getElementById('current-year').textContent = new Date().getFullYear();

      // Tab switching functionality
      function switchTab(tabId) {
        // Hide all tab contents
        const tabContents = document.querySelectorAll('.tab-content');
        tabContents.forEach(content => {
          content.classList.add('hidden');
        });

        // Show selected tab content
        document.getElementById(`${tabId}-content`).classList.remove('hidden');

        // Update tab styles
        document.querySelectorAll('button[id$="-tab"]').forEach(tab => {
          tab.classList.remove('text-brand-600', 'border-b-2', 'border-brand-500');
          tab.classList.add('text-gray-500');
        });

        document.getElementById(`${tabId}-tab`).classList.remove('text-gray-500');
        document.getElementById(`${tabId}-tab`).classList.add('text-brand-600', 'border-b-2', 'border-brand-500');
      }

    </script>

@endsection
