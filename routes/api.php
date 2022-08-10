<?php

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

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});
Route::namespace('App\Http\Controllers\Api\V1')->group(function () {
    Route::prefix('v1')->group(function () {
        Route::prefix('room')->group(function () {
            Route::post('store', [\App\Http\Controllers\Api\V1\Deck\RoomController::class, 'store']);
            Route::delete('delete/{room}', [\App\Http\Controllers\Api\V1\Deck\RoomController::class, 'delete']);
        });
        Route::prefix('deck')->group(function () {
            Route::prefix('spell')->group(function () {
                Route::post('new', [\App\Http\Controllers\Api\V1\Deck\SpellController::class, 'new']);
                Route::post('clear', [\App\Http\Controllers\Api\V1\Deck\SpellController::class, 'clear']);
            });
        });
    });
});
