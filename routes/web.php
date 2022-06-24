<?php

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ClientSideController;
use App\Http\Controllers\ResourceController;
use App\Http\Controllers\SkillController;
use Illuminate\Support\Facades\Route;


Route::controller(ClientSideController::class)->group(function () {
    Route::get('/', 'index');
    Route::get('/skill-details/{skill}', 'skillDetails')->name('skillDetails');
});

Route::prefix('admin')->middleware(['auth'])->group(function() {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    Route::resource('categories', CategoryController::class);

    Route::resource('skills', SkillController::class);

    Route::resource('resources', ResourceController::class);

    Route::resource('appointments', AppointmentController::class);
});

Route::get('/test', function () {
    return view('client.index');
});

require __DIR__.'/auth.php';
