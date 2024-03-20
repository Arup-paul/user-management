<?php

namespace App\Listeners;

use App\Events\UserAddressSaved;
use App\Models\Address;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Event;

class SaveUserAddressesListener
{
    public function handle(UserAddressSaved $event)
    {
         $count = 0;
        if (Event::hasListeners(UserAddressSaved::class)) {
            $listeners = Event::getListeners(UserAddressSaved::class);
            $count = count($listeners);
        }

        if ($count > 1) {
            return;
        }

        $user = $event->user;

         Address::create([
            'user_id' => $user->id,
            'address' => $event->data['address'],
         ]);


    }
}
