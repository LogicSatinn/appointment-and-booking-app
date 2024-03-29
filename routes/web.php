<?php

use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ClientSideController;
use App\Http\Livewire\Blog\Index;
use App\Http\Livewire\Blog\Show;
use App\Http\Livewire\Client\Cart;
use App\Http\Livewire\Client\EnrollClient;
use Illuminate\Support\Facades\Route;

Route::controller(ClientSideController::class)->group(function () {
    Route::get('/', 'index')->name('home');
    Route::get('/skills', 'skills')->name('skills');
    Route::get('/skill-details/{skill}', 'skillDetails')->name('skillDetails');
    Route::get('/timetable-details/{timetable}', 'timetableDetails')->name('timetableDetails');
});

Route::get('/blog/published', Index::class)->name('blog.published');
Route::get('/blog/{post}', Show::class)->name('show-blog');

Route::get('timetable/enroll-client/{timetable}', EnrollClient::class)->name('enroll-client');
Route::get('/cart/{timetable}/{client}', Cart::class)->name('cart');
Route::controller(CheckoutController::class)->prefix('checkout')->group(function () {
    Route::get('/{reservation}/{timetable}/{client}', 'index')->name('client.checkout');
    Route::get('/reservation-complete/{booking}/{timetable}/{client}', 'reservationComplete')->name('reservation-complete');
});

Route::get('test', function () {
//    return \Shoket\Laravel\Facades\Shoket::makePaymentRequest([
//        'amount' => '100',
//        'customer_name' => 'John Doe',
//        'email' => 'john@doe.com',
//        'number_used' => '255692107171',
//        'channel' => 'Airtel'
//    ]);

    return \Shoket\Laravel\Facades\Shoket::verifyPaymentRequest(
        reference: '2HMdJl84Pk0Qp2I47IdII',
        data: [
            'provider_name' => 'Airtel',
            'provider_code' => 'AirtelMoney'
        ]);
});

require __DIR__ . '/auth.php';
