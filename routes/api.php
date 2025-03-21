<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductsController;

//API Routes for the products CRUD
Route::group(['prefix' => '/products'], function () {
    Route::get('/', [ProductsController::class, 'index']);
    Route::post('/', [ProductsController::class, 'store']);
    Route::get('/{id}', [ProductsController::class, 'show']);
    Route::put('/{id}', [ProductsController::class, 'update']);
    Route::delete('/{id}', [ProductsController::class, 'destroy']);
    Route::put('/add-stock/{id}', [ProductsController::class, 'addStock']);
    Route::put('/subtract-stock/{id}', [ProductsController::class, 'subtractStock']);
});

//Fallback route
Route::fallback(function(){
    return response()->json([
        'message' => 'Page Not Found'
    ], 404);
});