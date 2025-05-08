@extends('layouts.frontend.app')
@section('body')

<main class="flex-grow container mx-auto px-4 py-8">
    <div class="max-w-2xl mx-auto bg-white rounded-lg shadow-md border border-gray-200 p-6">
        <h1 class="text-2xl font-bold mb-4">Reschedule Reservation</h1>
        <p class="text-gray-600 mb-6">Update the date and time for your reservation.</p>

        <div class="mb-4">
            <label for="service-name" class="block text-gray-700 text-sm font-bold mb-2">Service Name</label>
            <input type="text" id="service-name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ $reservation->service->name }}" readonly>
        </div>

        <div class="mb-4">
            <label for="current-date" class="block text-gray-700 text-sm font-bold mb-2">Current Date</label>
            <input type="text" id="current-date" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ $reservation->from }}" readonly>
        </div>

        <div class="mb-4">
            <label for="new-date" class="block text-gray-700 text-sm font-bold mb-2">New Date</label>
            <input type="date" id="new-date" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>

        <div class="mb-4">
            <label for="new-time" class="block text-gray-700 text-sm font-bold mb-2">New Time</label>
            <input type="time" id="new-time" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>

        <div class="flex items-center justify-between">
            <a href="{{ route('dashboard.index') }}" class="inline-block align-baseline font-semibold text-brand-500 hover:text-brand-800">
                Back to Dashboard
            </a>
            <form action="{{ route('reservation.update', $reservation->id) }}" method="POST">
                @csrf
                @method('patch')
                <button type="submit" class="bg-brand-500 hover:bg-brand-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Reschedule
                </button>
            </form>

        </div>
    </div>
</main>
@endsection
