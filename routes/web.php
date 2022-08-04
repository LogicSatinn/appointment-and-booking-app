<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\TimetableController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ClientSideController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\ResourceController;
use App\Http\Controllers\SkillController;
use App\Http\Livewire\Client\Cart;
use App\Http\Livewire\Client\EnrollClient;
use Illuminate\Support\Facades\Route;

Route::controller(ClientSideController::class)->group(function () {
    Route::get('/', 'index')->name('home');
    Route::get('/skills', 'skills')->name('skills');
    Route::get('/skill-details/{skill}', 'skillDetails')->name('skillDetails');
    Route::get('/timetable-details/{timetable}', 'timetableDetails')->name('timetableDetails');
});

Route::get('timetable/enroll-client/{timetable}', EnrollClient::class)->name('enroll-client');
Route::get('/cart/{timetable}/{client}', Cart::class)->name('cart');
Route::controller(CheckoutController::class)->prefix('checkout')->group(function () {
    Route::get('/{timetable}/{client}', 'index')->name('client.checkout');
    Route::get('/reservation-complete/{booking}/{timetable}/{client}', 'reservationComplete')->name('reservation-complete');
});

Route::prefix('admin')->middleware(['auth'])->group(function() {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    Route::controller(SettingsController::class)->prefix('settings')->group(function () {
        Route::get('/index', 'index')->name('settings.index');
        Route::post('/general-settings', 'storeGeneralSettings')->name('settings.storeGeneralSettings');
        Route::post('/beem-settings', 'storeBeemSettings')->name('settings.storeBeemSettings');
        Route::post('/other-settings', 'storeOtherSettings')->name('settings.storeOtherSettings');
    });

    Route::view('/calendar/index', 'admin.calendar.index')->name('calendar.index');

    Route::resource('categories', CategoryController::class);

    Route::controller(SkillController::class)->prefix('skills')->group(function () {
        Route::get('/archive-skill/{skill}', 'archiveSkill')->name('archive-skill');
        Route::get('/publish-skill/{skill}', 'publishSkill')->name('publish-skill');
    });

    Route::resource('skills', SkillController::class);

    Route::resource('resources', ResourceController::class);

    Route::resource('timetables', TimetableController::class);

    Route::resource('bookings', BookingController::class)->only(['index', 'destroy']);
});

require __DIR__.'/auth.php';


Route::resource('instructor', App\Http\Controllers\InstructorController::class);
