<?php

namespace App\Http\Controllers;

use App\Events\UserAddressSaved;
use App\Models\User;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    public function create(User $user)
    {
        return view('address.create', compact('user'));
    }

    public function store(Request $request, User $user)
    {
        $validatedData = $request->validate([
            'address' => 'required'
        ]);
        UserAddressSaved::dispatch($user, $validatedData);
        return redirect()->route('users.show',$user)->with('success', 'Address created successfully');
    }

}
