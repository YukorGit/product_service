<?php

use App\Presenters\Api\V1\Controllers\ProductSearchController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');*/

Route::get('/products', [ProductSearchController::class, 'index']);
