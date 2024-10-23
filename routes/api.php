<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FoodLogController;
use App\Http\Controllers\ProductController;

Route::get('/data', function (Request $request) {
    return response()->json([
        'message' => 'API работает!',
        'data' => ['Продукт 1', 'Продукт 2', 'Продукт 3']
    ]);
});
Route::apiResource('users', UserController::class);
Route::apiResource('products', ProductController::class);
Route::apiResource('food-logs', FoodLogController::class);