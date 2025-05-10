@php
    $today = \Carbon\Carbon::today();
    $maxDate = $today->copy()->addDays(7);
@endphp
@extends('layouts.frontend.app')
@section('body')

<main class="flex-grow container mx-auto px-4 py-8">
    <div class="max-w-2xl mx-auto bg-white rounded-lg shadow-md border border-gray-200 p-6">
        <h1 class="text-2xl font-bold mb-4">Reschedule Reservation</h1>
        <p class="text-gray-600 mb-6">Update the date and time for your reservation.</p>

        <div class="mb-4">
            <label for="service-name" class="block text-gray-700 text-sm font-bold mb-2">{{$reservation->service->name}}</label>
            <input type="text" id="service-name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ $reservation->service->name }}" readonly>
        </div>

        <form action="{{ route('reservation.update' , $reservation) }}" method="POST">
            @csrf
            @method('patch')
            @if ($errors->any())
            <div class="mb-4 text-red-600">
              <ul class="list-disc list-inside text-sm">
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          @endif
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

            <div class="mt-6">
                <button type="submit" class="bg-brand-500 hover:bg-brand-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Reschedule
                </button>
              </a>
            </div>
        </form>
        <div class="flex items-center justify-between">
            <a href="{{ route('dashboard.index') }}" class="inline-block align-baseline font-semibold text-brand-500 hover:text-brand-800">
                Back to Dashboard
            </a>

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
