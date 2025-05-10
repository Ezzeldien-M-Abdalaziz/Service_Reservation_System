@extends('layouts.frontend.app')
@section('body')

    <main class="flex-grow py-12">
      <div class="container mx-auto px-4">
        <div class="mb-12">
          <h1 class="text-3xl font-bold text-center">Our Services</h1>
          <p class="text-center text-gray-600 mt-4 max-w-2xl mx-auto">
            Browse our range of professional services and book with ease.
            All our service providers are vetted and highly rated.
          </p>
        </div>

        <!-- Services Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

            @foreach($services as $service)
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <div class="p-6">
                      <h3 class="text-xl font-semibold mb-2">{{$service->name}}</h3>
                      <div class="flex items-center mb-3">
                        <div class="flex text-yellow-400">
                          <div class="flex text-yellow-400">
                            @for ($i = 0; $i < $service->rating; $i++)
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                              </svg>
                            @endfor
                        </div>

                        </div>
                        <span class="text-gray-600 text-sm ml-2">({{rand(50, 100)}} reviews)</span>
                      </div>
                      <p class="text-gray-600 mb-4">{{$service->description}}</p>
                      <div class="flex justify-between items-center">
                        <span class="text-brand-600 font-bold">${{$service->price}}/session</span>
                        <a href="{{route('book-service' , $service->id)}}" class="bg-brand-600 text-white px-4 py-2 rounded hover:bg-brand-700">Book Now</a>
                      </div>
                    </div>
                  </div>
            @endforeach


        </div>

        <!-- Pagination -->
       <!-- Laravel Pagination Links -->
        <div class="flex justify-center mt-12">
            {{ $services->links('vendor.pagination.tailwind') }}
        </div>
      </div>
    </main>
    @endsection

