<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});


Route::resource('category', App\Http\Controllers\CategoryController::class);


Route::resource('resource', App\Http\Controllers\ResourceController::class);


Route::resource('client', App\Http\Controllers\ClientController::class);


Route::resource('course', App\Http\Controllers\CourseController::class);


Route::resource('tag', App\Http\Controllers\TagController::class);


Route::resource('appointment', App\Http\Controllers\AppointmentController::class);


Route::resource('booking', App\Http\Controllers\BookingController::class);


Route::resource('reservation', App\Http\Controllers\ReservationController::class);


Route::resource('payment', App\Http\Controllers\PaymentController::class);
