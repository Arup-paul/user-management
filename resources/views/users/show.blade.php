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

                <div class="  p-6 text-black border border-gray-200 rounded-lg shadow  ">
                     <h5 class="mb-2 text-xl  tracking-tight text-gray-900 "> <strong>Name:</strong> {{$user->name ?? ''}}</h5>
                     <h5 class="mb-2 text-xl  tracking-tight text-gray-900 "> <strong>Email:</strong> {{$user->email ?? ''}}</h5>
                    <h5 class="mb-2 text-xl  tracking-tight text-gray-900 "> <strong>Photo:</strong> </h5>
                    @if($user->photo)
                        <img src="{{ asset('storage/photos/' . $user->photo) }}"  class="rounded-full h-10 w-10" alt="User Photo">
                    @else
                            <?php
                            $hash = md5(strtolower(trim($user->email)));
                            $avatarUrl = "https://www.gravatar.com/avatar/$hash?s=100&d=mp";
                            ?>
                        <img src="{{ $avatarUrl }}"  class="rounded-full h-10 w-10" alt="Default Avatar">
                    @endif


                    @if(count($user->addresses) > 0)
                    <h2 class="mb-2 text-xl  tracking-tight text-gray-900">Address: </h2>
                    <ul class="max-w-md space-y-1   list-disc list-inside  ">
                        @foreach($user->addresses as $key =>  $address)
                            <li>
                               {{$key+1}}. {{$address->address}}
                            </li>
                        @endforeach
                    </ul>
                    @endif


                </div>




            </div>
        </div>
    </div>
</x-app-layout>
