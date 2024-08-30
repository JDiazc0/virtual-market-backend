<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\PromotionController;
use App\Http\Controllers\Api\ShoppingCartController;
use App\Http\Controllers\Api\StoreController;

// Public routes
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::post('forgot-password', [AuthController::class, 'forgotPassword']);
Route::post('reset-password', [AuthController::class, 'resetPassword'])->name('password.reset');
Route::get('products', [ProductController::class, 'getProducts']);
Route::get('products/{id}', [ProductController::class, 'getProduct']);
Route::get('stores', [StoreController::class, 'getStores']);
Route::get('store/{id}', [StoreController::class, 'getStore']);
Route::get('promotions', [PromotionController::class, 'getPromotions']);

// Protected routes
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('logout', [AuthController::class, 'logout']);

    // Protected store routes
    Route::group(['middleware' => ['userType:store'], 'prefix' => 'store'], function () {
        Route::post('add-products', [StoreController::class, 'addProducts']);
        Route::post('add-promotions', [StoreController::class, 'addPromotions']);
        Route::post('active-promotions', [StoreController::class, 'activatePromotion']);
        Route::post('deactive-promotions', [StoreController::class, 'deactivatePromotion']);
    });

    // Protected user client routes
    Route::group(['middleware' => ['userType:client'], 'prefix' => 'user-client'], function () {
        Route::post('shoppingCart', [ShoppingCartController::class, 'addOrUpdateShoppingCart']);
        Route::delete('shoppingCart', [ShoppingCartController::class, 'deleteFromShoppingCart']);
    });
});
