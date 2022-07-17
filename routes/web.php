<?php

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ClientSideController;
use App\Http\Controllers\EnrollClientController;
use App\Http\Controllers\ResourceController;
use App\Http\Controllers\SkillController;
use App\Http\Livewire\Client\Cart;
use Illuminate\Support\Facades\Route;


Route::controller(ClientSideController::class)->group(function () {
    Route::get('/', 'index');
    Route::get('/skill-details/{skill}', 'skillDetails')->name('skillDetails');
    Route::get('/appointment-details/{appointment}', 'appointmentDetails')->name('appointmentDetails');
});

Route::post('/{appointment}/client/enroll', [EnrollClientController::class, 'enroll'])->name('enroll.client');
Route::get('/cart/{appointment}/{client}', Cart::class)->name('cart');
Route::get('/checkout/{appointment}/{client}', [CheckoutController::class, 'index'])->name('client.checkout');

Route::prefix('admin')->middleware(['auth'])->group(function() {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    Route::resource('categories', CategoryController::class);

    Route::resource('skills', SkillController::class);

    Route::resource('resources', ResourceController::class);

    Route::resource('appointments', AppointmentController::class);
});


require __DIR__.'/auth.php';
