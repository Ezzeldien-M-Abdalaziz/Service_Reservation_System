@extends('admin.home')

@section('body')
    <main class="flex-1 p-6 overflow-y-auto">
        <h2 class="text-2xl font-semibold mb-6">Users</h2>

        <div class="bg-white rounded-md shadow-md p-4">
            <h3 class="text-lg font-semibold mb-4">Registered Users</h3>
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
                                Email
                            </th>
                            <th class="px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold uppercase tracking-wider">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white">
                        @foreach($users as $user)
                        <tr>
                            <td class="px-5 py-5 border-b border-gray-200 text-sm">
                                {{$user->id}}
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 text-sm">
                                {{$user->name}}
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 text-sm">
                                {{$user->email}}
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 text-sm">
                                <form action="{{ route('admin.user.delete', $user->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                        Delete
                                    </button>
                                </form>

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
            {{ $users->links('vendor.pagination.tailwind') }}
        </div>
    </main>
@endsection
