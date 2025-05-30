<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\UserController;
use App\Http\Controllers\Api\V1\SessionController;
use App\Http\Controllers\Api\V1\ProductsController;

Route::group(['prefix' => 'V1'], function(){
    Route::apiResource('users', UserController::class);
    Route::apiResource('login', SessionController::class);
    Route::apiResource('products', ProductsController::class)->only(['index', 'show']);
});

// Route::get('/users/{id}', [UserController::class, 'show']);

Route::middleware(['auth:sanctum'])->prefix('V1/dashboard')->group(function () {
    Route::apiResource('products', ProductsController::class)->only(['store', 'destroy']);
    // Route::delete('/products/{id}', [ProductsController::class, 'destroy']);
});