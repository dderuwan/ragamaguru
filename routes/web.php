<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


Route::get('/', function () {
    // return view('frontend.home');
});

Auth::routes();

Route::resource('customer', CustomerController::class);

Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');

Route::get('/allcustomers', [CustomerController::class,'index'])->name('allcustomers');

Route::get('/createCustomer', [CustomerController::class, 'create'])->name('CustomerRegister');

Route::post('/storeCustomer', [CustomerController::class, 'store'])->name('customer.store');

Route::post('/verifyCustomer', [CustomerController::class, 'verify'])->name('customer.verify');

Route::get('/editCustomer/{id}', [CustomerController::class, 'edit'])->name('customer.edit');

Route::post('/updateCustomer', [CustomerController::class, 'update'])->name('customer.update');

Route::delete('/deleteCustomer/{id}', [CustomerController::class, 'destroy'])->name('customer.destroy');

