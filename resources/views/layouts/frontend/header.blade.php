    <!-- Navbar -->
    <nav class="bg-white shadow-sm">
        <div class="container mx-auto px-4">
          <div class="flex justify-between items-center py-4">
            <a href="/" class="flex items-center">
              <span class="text-xl font-bold text-brand-600">ReserveEasy</span>
            </a>

            @php
            if(Auth::check()) {
                $title = "Your Dashboard";
            }else{
                $title = "Home";
            }
            @endphp

            <div class="flex space-x-4 items-center">
              <a href="/" class="text-gray-700 hover:text-brand-500">{{$title}}</a>
              <a href="{{route('services')}}" class="text-gray-700 hover:text-brand-500">Services</a>

              @if (Auth::check())
              <form method="POST" action="{{ route(name: 'logout') }}" class="inline">
                @csrf
                <button class="text-gray-700 hover:text-brand-500">Logout</button>
                </form>
              @endif


            </div>
          </div>
        </div>
      </nav>

    <!-- end Navbar -->

