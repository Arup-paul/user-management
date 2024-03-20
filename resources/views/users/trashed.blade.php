<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
              Trashed
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                @if(session('success'))
                    <div class="text-green-600 p-3 font-semibold">{{ session('success') }}</div>
                @endif



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
                    @if($trashedUsers->isEmpty())
                        <tr>
                            <td colspan="4" class="px-6 py-4 text-center whitespace-nowrap">No trashed users found.</td>
                        </tr>
                    @else
                    @foreach($trashedUsers as $user)
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
                                <form action="{{ route('users.restore', $user->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="text-indigo-600 hover:text-indigo-900"  onclick="return confirm('Are you sure you want to Restore this user?')">Restore</button>
                                </form>
                                <form action="{{ route('users.force-delete', $user->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900"  onclick="return confirm('Are you sure you want to permanently delete  this user?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    @endif

                    </tbody>
                </table>
                {{ $trashedUsers->links()}}
            </div>
        </div>
    </div>
</x-app-layout>
