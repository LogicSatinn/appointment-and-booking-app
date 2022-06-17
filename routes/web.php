<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SkillController;
use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return view('welcome');
});

Route::prefix('admin')->middleware(['auth'])->group(function() {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    Route::resource('categories', CategoryController::class);

    Route::resource('skills', SkillController::class);
});



require __DIR__.'/auth.php';
