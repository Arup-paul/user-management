<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/users/trashed', [UserController::class,'trashed'])->name('users.trashed');
    Route::put('/users/{user}/restore', [UserController::class,'restore'])->name('users.restore');
    Route::delete('/users/{user}/force-delete', [UserController::class,'forceDelete'])->name('users.force-delete');
    Route::get('/users/{user}/addresses/create', [AddressController::class,'create'])->name('addresses.create');
    Route::post('/users/{user}/addresses', [AddressController::class,'store'])->name('addresses.store');
    Route::resource('users',UserController::class);




    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
