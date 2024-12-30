<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

//Auth::routes();


Route::group(['middleware' => 'auth:web','prefix' => 'admin'], function () {
    Route::get('/home', [HomeController::class, 'index']);
    Route::resource('categories', CategoryController::class);
    Route::resource('products', ProductController::class);
    Route::resource('orders', OrderController::class);


//    Route::resource('settings', SettingController::class);
//    Route::resource('clients', ClientController::class);
//    Route::get('/clients/activate/{id}', [ClientController::class, 'activate'])->name('clients.activate');
//    Route::get('/clients/de-activate/{id}', [ClientController::class, 'deActivate'])->name('clients.de-activate');
//    Route::resource('users', UserController::class);
//    Route::resource('roles', RoleController::class);
//    Route::get('change-password', [UserController::class, 'changePassword'])->name('change-password');
//    Route::post('update-password', [UserController::class, 'updatePassword'])->name('update-password');
//    Route::get('logout', [UserController::class, 'logout']);

});





