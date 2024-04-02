<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserFinancialYearController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

//You have to write an endpoint that will take a date as a required parameter.
// You have to identify the financial year range from this date and return all
// the users that have been created within that financial year. Note that,
// a financial year starts on July 1st, and ends on June 30th


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/user/financial-year/{date}', [UserFinancialYearController::class, 'userFinancialYear'])->name('user.financial-year');

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
