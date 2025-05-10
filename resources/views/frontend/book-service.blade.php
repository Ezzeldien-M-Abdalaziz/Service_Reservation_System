@php
    $today = \Carbon\Carbon::today();
    $maxDate = $today->copy()->addDays(7);
@endphp

@extends('layouts.frontend.app')

@section('body')


    <main class="flex-grow py-12">
      <div class="container mx-auto px-4">
        <!-- Breadcrumb -->
        <nav class="flex mb-8" aria-label="Breadcrumb">
          <ol class="inline-flex items-center space-x-1 md:space-x-3">
            <li class="inline-flex items-center">
              <a href="/" class="text-gray-700 hover:text-brand-500">Home</a>
            </li>
            <li>
              <div class="flex items-center">
                <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                <a href="{{ route('services') }}" class="ml-1 text-gray-700 hover:text-brand-500 md:ml-2">Services</a>
              </div>
            </li>
            <li aria-current="page">
              <div class="flex items-center">
                <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                <span class="ml-1 text-gray-500 md:ml-2">{{$service->name}}</span>
              </div>
            </li>
          </ol>
        </nav>

        <div class="grid grid-cols-1 lg:grid-cols-1 gap-8">
          <!-- Service Information -->
          <div class="lg:col-span-2">
              <div class="p-6">
                <div class="flex items-center justify-between mb-4">
                  <h1 class="text-3xl font-bold text-gray-900">{{$service->name}}</h1>
                  <span class="text-2xl font-bold text-brand-600">${{$service->price}}/hour</span>
                </div>

                <div class="flex items-center mb-6">
                  <div class="flex text-yellow-400">
                    @for ($i = 0; $i < $service->rating; $i++)
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                              </svg>
                            @endfor
                  </div>
                  <span class="text-gray-600 text-sm ml-2">({{rand(50, 100)}} reviews)</span>
                </div>

                <h2 class="text-xl font-semibold mb-4">Description</h2>
                <p class="text-gray-600 mb-6">
                  {{ $service->description }}
                </p>
          </div>

          <!-- Booking Section -->
          <div class="lg:col-span-1">
            <div class="bg-white rounded-lg shadow-md p-6 sticky top-6">
              <h2 class="text-xl font-bold mb-6">Book This Service</h2>

              <form action="{{ route('reservation.book') }}" method="POST">
                @csrf
                @if ($errors->any())
                <div class="mb-4 text-red-600">
                  <ul class="list-disc list-inside text-sm">
                    @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                    @endforeach
                  </ul>
                </div>
              @endif
                <input type="hidden" name="service_id" value="{{ $service->id }}">
                <div class="mb-4">
                  <label for="service-date" class="block text-sm font-medium text-gray-700 mb-1">Select Date</label>
                  <input
                    type="date"
                    id="service-date"
                    name="date"
                    min="{{ $today->toDateString() }}"
                    max="{{ $maxDate->toDateString() }}"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-brand-500"
                    required
                  />
                </div>

                <div class="mb-4">
                  <label for="from" class="block text-sm font-medium text-gray-700 mb-1">From</label>
                  <select
                    id="datePicker"
                    name="from"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-brand-500"
                    required
                  >
                    <option value="">Select a time</option>
                    <option value="08:00">8:00 AM</option>
                    <option value="08:30">8:30 AM</option>
                      <option value="09:00">9:00 AM</option>
                      <option value="09:30">9:30 AM</option>
                      <option value="10:00">10:00 AM</option>
                      <option value="10:30">10:30 AM</option>
                      <option value="11:00">11:00 AM</option>
                      <option value="11:30">11:30 AM</option>
                      <option value="12:00">12:00 PM</option>
                      <option value="12:30">12:30 PM</option>
                      <option value="13:00">1:00 PM</option>
                      <option value="13:30">1:30 PM</option>
                      <option value="14:00">2:00 PM</option>
                      <option value="14:30">2:30 PM</option>
                      <option value="15:00">3:00 PM</option>
                      <option value="15:30">3:30 PM</option>
                      <option value="16:00">4:00 PM</option>
                      <option value="16:30">4:30 PM</option>
                      <option value="17:00">5:00 PM</option>
                      <option value="17:30">5:30 PM</option>
                      <option value="18:00">6:00 PM</option>
                      <option value="18:30">6:30 PM</option>
                      <option value="19:00">7:00 PM</option>
                      <option value="19:30">7:30 PM</option>
                  </select>
                </div>

                <div class="mb-4">
                    <label for="to" class="block text-sm font-medium text-gray-700 mb-1">To</label>
                    <select
                      id="datePicker"
                      name="to"
                      class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-brand-500"
                      required
                    >
                      <option value="">Select a time</option>
                      <option value="08:30">8:30 AM</option>
                      <option value="09:00">9:00 AM</option>
                      <option value="09:30">9:30 AM</option>
                      <option value="10:00">10:00 AM</option>
                      <option value="10:30">10:30 AM</option>
                      <option value="11:00">11:00 AM</option>
                      <option value="11:30">11:30 AM</option>
                      <option value="12:00">12:00 PM</option>
                      <option value="12:30">12:30 PM</option>
                      <option value="13:00">1:00 PM</option>
                      <option value="13:30">1:30 PM</option>
                      <option value="14:00">2:00 PM</option>
                      <option value="14:30">2:30 PM</option>
                      <option value="15:00">3:00 PM</option>
                      <option value="15:30">3:30 PM</option>
                      <option value="16:00">4:00 PM</option>
                      <option value="16:30">4:30 PM</option>
                      <option value="17:00">5:00 PM</option>
                      <option value="17:30">5:30 PM</option>
                      <option value="18:00">6:00 PM</option>
                      <option value="18:30">6:30 PM</option>
                      <option value="19:00">7:00 PM</option>
                      <option value="19:30">7:30 PM</option>
                      <option value="20:00">8:00 PM</option>
                    </select>
                  </div>

                <div class="mt-6 p-4 bg-gray-50 rounded-md">
                  <div class="flex justify-between mb-2">
                    <span class="text-gray-600">Service Rate</span>
                    <span class="font-medium">${{ $service->price }}/hour</span>
                  </div>
                  <div class="border-t border-gray-200 mt-2 pt-2 flex justify-between font-bold">
                    <span>Total</span>
                    <span>$105</span>
                  </div>
                </div>

                <div class="mt-6">
                    <button type="submit" class="w-full bg-brand-600 text-white py-3 px-4 rounded-md hover:bg-brand-700 focus:outline-none focus:ring-2 focus:ring-brand-500 focus:ring-offset-2">
                        Book Now
                    </button>
                  </a>
                </div>
            </form>


            </div>
        </div>
        </div>
    </div>

    </div>
    </main>

    <script>
        const unavailableTimesByDate = @json($unavailableTimesByDate);

        function parseTime(timeStr) {
            const [hours, minutes] = timeStr.split(':').map(Number);
            return hours * 60 + minutes;
        }

        function updateTimeSelects(date) {
            const fromSelect = document.querySelector('select[name="from"]');
            const toSelect = document.querySelector('select[name="to"]');
            const unavailableSlots = unavailableTimesByDate[date] || [];

            // Update 'From' dropdown
            Array.from(fromSelect.options).forEach(option => {
                if (option.value === '') return;

                const slotTime = parseTime(option.value);
                let isUnavailable = false;

                for (const {from, to} of unavailableSlots) {
                    const fromTime = parseTime(from);
                    const toTime = parseTime(to);

                    if (slotTime >= fromTime && slotTime < toTime) {
                        isUnavailable = true;
                        break;
                    }
                }

                option.disabled = isUnavailable;
                option.style.color = isUnavailable ? '#999' : '';
            });

            // Update 'To' dropdown
            Array.from(toSelect.options).forEach(option => {
                if (option.value === '') return;

                const slotTime = parseTime(option.value);
                let isUnavailable = false;

                for (const {from, to} of unavailableSlots) {
                    const fromTime = parseTime(from);
                    const toTime = parseTime(to);

                    if (slotTime > fromTime && slotTime <= toTime) {
                        isUnavailable = true;
                        break;
                    }
                }

                option.disabled = isUnavailable;
                option.style.color = isUnavailable ? '#999' : '';
            });
        }

        // Listen for date changes
        document.getElementById('service-date').addEventListener('change', (e) => {
            updateTimeSelects(e.target.value);
        });

        // Initialize on page load if a date is already selected
        const initialDate = document.getElementById('service-date').value;
        if (initialDate) {
            updateTimeSelects(initialDate);
        }
    </script>


    @endsection
