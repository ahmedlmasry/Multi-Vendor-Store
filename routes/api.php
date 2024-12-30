<?php

use App\Http\Controllers\Api\AccessTokensController;
use App\Http\Controllers\Api\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::group(['prefix'=>'v1'], function () {
    Route::Resource('products', ProductController::class);
    Route::post('auth/access-tokens', [AccessTokensController::class, 'store'])
        ->middleware('guest:sanctum');

    Route::delete('auth/access-tokens/{token?}', [AccessTokensController::class, 'destroy'])
        ->middleware('auth:sanctum');
});
