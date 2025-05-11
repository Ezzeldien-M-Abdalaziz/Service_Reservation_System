@extends('admin.home')

@section('body')
    <main class="flex-1 p-6 overflow-y-auto">
        <h2 class="text-2xl font-semibold mb-6">Services</h2>

        <div class="bg-white rounded-md shadow-md p-4 mb-6">
            <h3 class="text-lg font-semibold mb-4">All Services</h3>
            <div class="overflow-x-auto">
                <table class="min-w-full leading-normal shadow-md rounded-lg overflow-hidden">
                    <thead class="bg-gray-200 text-gray-700">
                        <tr>
                            <th class="px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold uppercase tracking-wider">
                                ID
                            </th>
                            <th class="px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold uppercase tracking-wider">
                                Name
                            </th>
                            <th class="px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold uppercase tracking-wider">
                                Description
                            </th>
                            <th class="px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold uppercase tracking-wider">
                                Price
                            </th>
                            <th class="px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold uppercase tracking-wider">
                                Rating
                            </th>
                            <th class="px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold uppercase tracking-wider">
                                Availability
                            </th>
                            <th class="px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold uppercase tracking-wider">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white">
                        @foreach ($services as $service)
                            <tr>
                            <td class="px-5 py-5 border-b border-gray-200 text-sm">
                                {{ $service->id }}
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 text-sm">
                                {{ $service->name }}
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 text-sm">
                                {{ $service->description }}
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 text-sm">
                                {{ $service->price }} $
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 text-sm">
                                {{ $service->rating }}
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 text-sm">
                                <span class="relative inline-block px-3 py-1 font-semibold text-green-900 leading-tight">
                                    <span aria-hidden="true" class="absolute inset-0 bg-green-200 opacity-50 rounded-full"></span>
                                    <span class="relative">{{ $service->available ? 'Available' : 'Unavailable' }}</span>
                                </span>
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 text-sm">
                                <div class="flex space-x-2">
                                    <form action="{{ route('admin.service.change-availability', $service->id) }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="available" value="{{ $service->available ? 0 : 1 }}">
                                        <button type="submit"
                                            class="{{ $service->available ? 'bg-yellow-500 hover:bg-yellow-700' : 'bg-green-500 hover:bg-green-700' }} text-white font-bold py-2 px-4 rounded">
                                                {{ $service->available ? 'Unavailable' : 'Available' }}
                                        </button>
                                    </form>

                                </div>
                            </td>
                        </tr>
                        @endforeach


                    </tbody>
                </table>
            </div>
             <!-- Pagination -->
       <!-- Laravel Pagination Links -->
        <div class="flex justify-center mt-12">
            {{ $services->links('vendor.pagination.tailwind') }}
        </div>
        </div>
    </main>


@endsection
