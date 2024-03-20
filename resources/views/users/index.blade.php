<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Users
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                @if(session('success'))
                    <div class="text-green-600 p-3 font-semibold">{{ session('success') }}</div>
                @endif

                <div class="flex justify-between items-center px-6 py-4">
                    <h3 class="text-lg font-semibold text-gray-700">User List  </h3>
                    <a class="bg-indigo-50  text-green-600 font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" href="{{route('users.create')}}">Add New</a>
                </div>


                <table class="w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-center   text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Name
                        </th>
                        <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Email
                        </th>
                        <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                           Photo
                        </th>
                        <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Actions
                        </th>
                    </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                    @if($users->isEmpty())
                        <tr>
                            <td colspan="4" class="px-6 py-4 text-center whitespace-nowrap">No users found.</td>
                        </tr>
                    @else
                    @foreach($users as $user)
                        <tr>
                            <td class="px-6 py-4 text-center whitespace-nowrap">
                                {{ $user->name }}
                            </td>
                            <td class="px-6 py-4 text-center whitespace-nowrap">
                                {{ $user->email }}
                            </td>
                            <td class="px-6 py-4 text-center whitespace-nowrap">
                                @if($user->photo)
                                    <img src="{{ asset('storage/photos/' . $user->photo) }}"  class="rounded-full h-10 w-10" alt="User Photo">
                                @else
                                        <?php
                                        $hash = md5(strtolower(trim($user->email)));
                                        $avatarUrl = "https://www.gravatar.com/avatar/$hash?s=100&d=mp";
                                        ?>
                                    <img src="{{ $avatarUrl }}"  class="rounded-full h-10 w-10" alt="Default Avatar">
                                @endif
                            </td>
                            <td class="px-6 py-4 text-center whitespace-nowrap text-sm font-medium">
                                <div class="flex">
                                <a href="{{ route('addresses.create', $user->id) }}" title="Add New Address"  >
                                    <svg class="h-6 w-6 text-green-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                    </svg>
                                </a>
                                <a href="{{ route('users.show', $user->id) }}" class="text-gray-500  " title="Show">
                                    <svg class="h-6 w-6 text-blue-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2 12s3-8 10-8 10 8 10 8-3 8-10 8-10-8-10-8z"/>
                                    </svg>
                                </a>
                                <a href="{{ route('users.edit', $user->id) }}" class="text-indigo-600  " title="Edit">
                                    <svg class="h-6 w-6 text-indigo-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l7-7 2 2-7 7-2-2zM9 3a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2V9l-4-4H9z" />
                                    </svg>

                                </a>
                                <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600   ml-2" onclick="return confirm('Are you sure you want to delete this user?')" title="Delete">
                                        <svg class="h-6 w-6 text-red-600" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                            <path d="M19 6v13a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m1 0H18V5a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v1zM9 11h6v3a1 1 0 0 1-1 1H10a1 1 0 0 1-1-1v-3z" fill="currentColor" />
                                        </svg>

                                    </button>
                                </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    @endif
                    </tbody>
                </table>

                {{ $users->links()}}
            </div>
        </div>
    </div>
</x-app-layout>
