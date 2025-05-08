
  <!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>ReserveEasy - Book Services Online</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
      tailwind.config = {
        theme: {
          extend: {
            colors: {
              brand: {
                50: '#e6f1fe',
                100: '#cce3fd',
                200: '#99c7fb',
                300: '#66abf9',
                400: '#338ff7',
                500: '#0073f5',
                600: '#005cc4',
                700: '#004593',
                800: '#002e62',
                900: '#001731'
              }
            }
          }
        }
      }
    </script>
  </head>

  <body class="min-h-screen flex flex-col">


    @include('layouts.frontend.header')
        @if (session('success'))
        <div class="mb-4 p-4 text-green-800 bg-green-100 border border-green-200 rounded">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="mb-4 p-4 text-red-800 bg-red-100 border border-red-200 rounded">
            {{ session('error') }}
        </div>
    @endif
    @yield('body')

    @include('layouts.frontend.footer')



  </body>
</html>
