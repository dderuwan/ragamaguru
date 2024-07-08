<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


use App\Http\Controllers\TreatementController;

Route::get('/', function () {
    // return view('frontend.home');
});

Auth::routes();

// Route::resource('customer', CustomerController::class);

Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');

// customer module
Route::get('/allcustomers', [CustomerController::class,'index'])->name('allcustomers');
Route::get('/createCustomer', [CustomerController::class, 'create'])->name('createcustomer');
Route::post('/storeCustomer', [CustomerController::class, 'store'])->name('storecustomer');
Route::post('/verifyCustomer', [CustomerController::class, 'verify'])->name('verifycustomer');
Route::get('/editCustomer/{id}', [CustomerController::class, 'edit'])->name('editcustomer');
Route::post('/updateCustomer', [CustomerController::class, 'update'])->name('updatecustomer');
Route::delete('/deleteCustomer/{id}', [CustomerController::class, 'destroy'])->name('deletecustomer');


Route::get('/treatement', [App\Http\Controllers\TreatementController::class, 'index'])->name('treatement');

// Route::resource('Treatement', TreatementController::class);
