<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-100 h-screen flex">
    <aside class="bg-white w-64 border-r border-gray-200 hidden md:block">
        <div class="p-4">
            <h1 class="text-2xl font-bold text-gray-900">Dashboard</h1>
        </div>
        <div class="border-t border-gray-200"></div>
        <nav class="p-4 space-y-2">
            <a href="{{route('admin.dashboard')}}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 hover:text-blue-600 rounded-md items-center">
                Dashboard
            </a>
            <a href="{{route('admin.users')}}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 hover:text-blue-600 rounded-md items-center">
                Users
            </a>
            <a href="{{route('admin.reservations')}}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 hover:text-blue-600 rounded-md items-center">
                Reservations
            </a>
            <a href="{{route('admin.services')}}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 hover:text-blue-600 rounded-md items-center">
                Services
            </a>

            <form action="{{ route('admin.logout') }}" method="POST">
                @csrf
                <button type="submit" class="block w-full text-left px-4 py-2 text-gray-700 rounded-md items-center bg-red-400">
                    Logout
                </button>
            </form>
        </nav>
    </aside>



   @yield('body')


</body>
</html>
