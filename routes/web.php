<?php

use App\Http\Controllers\Front\CartController;
use App\Http\Controllers\Front\CheckoutController;
use App\Http\Controllers\Front\CurrencyConverterController;
use App\Http\Controllers\Front\MainController;
use App\Http\Controllers\Front\ProductController;
use App\Http\Controllers\Front\TwoFactorAuthentcationController;
use Illuminate\Support\Facades\Route;




Route::get('/', [MainController::class, 'index'])->name('home');
Route::get('/products',[ProductController::class,'index'])->name('products.index');
Route::get('/product/{product:slug}',[ProductController::class,'show'])->name('product.show');
Route::resource('carts', CartController::class);
Route::get('checkout',[CheckoutController::class,'create'])->name('checkout');
Route::post('checkout',[CheckoutController::class,'store'])->name('checkout.store');
Route::get('auth/user/2fa', [TwoFactorAuthentcationController::class, 'index'])
    ->name('front.2fa');
Route::post('currency', [CurrencyConverterController::class, 'store'])
    ->name('currency.store');


require __DIR__.'/dashboard.php';





