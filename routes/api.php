<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\OrderController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
  return $request->user();
});

Route::group(['prefix' => 'account'], function () {
  Route::post('/create', [AccountController::class, 'createAccount']);
  Route::get('/show', [AccountController::class, 'showAccount']);
  Route::post('/update', [AccountController::class, 'updateAccount']);
  Route::delete('/delete', [AccountController::class, 'deteleAccount']);
});

Route::group(['prefix' => 'order'], function () {
  Route::post('/create', [OrderController::class, 'createOrder']);
  Route::post('/update', [OrderController::class, 'updateOrder']);
  Route::delete('/cancel', [OrderController::class, 'cancelOrder']);
});
