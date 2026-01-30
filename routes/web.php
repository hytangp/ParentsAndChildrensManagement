<?php

use App\Http\Controllers\UserProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::get('/complete-profile', [UserProfileController::class, 'edit'])
        ->name('profile.complete');

    Route::post('/complete-profile', [UserProfileController::class, 'update'])
        ->name('profile.store');
});

Route::middleware(['auth', 'profile.completed'])->group(function () {
    Route::get('/', function () {
        return view('dashboard');
    })->name('dashboard');
    
    Route::resource('parents', App\Http\Controllers\ParentsController::class);
    Route::resource('childrens', App\Http\Controllers\ChildrensController::class);
});