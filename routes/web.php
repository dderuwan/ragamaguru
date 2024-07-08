<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\dashboardController;
use App\Http\Controllers\TreatementController;

Route::get('/', function () {
    // return view('frontend.home');

});

Auth::routes();

Route::get('/Treatement', [App\Http\Controllers\TreatementController::class, 'index'])->name('Treatement');

Route::resource('Treatement', TreatementController::class);

Route::get('/dashboard', [dashboardController::class, 'index'])->name('dashboard');


