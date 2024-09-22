<?php

use App\Http\Controllers\api\CategoryController;
use App\Http\Controllers\api\CustomerController;
use App\Http\Controllers\api\DiscountController;
use App\Http\Controllers\api\OrderController;
use App\Http\Controllers\api\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::resource('categories',CategoryController::class);
Route::resource('customers',CustomerController::class);
Route::resource('products',ProductController::class);
Route::resource('discounts',DiscountController::class);
Route::apiResource('orders',OrderController::class)->missing(function (Request $request) {
    return response()->json('bulunamadi');
});
