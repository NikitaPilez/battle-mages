<?php

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

        Route::post('room/store', [\App\Http\Controllers\Api\V1\Room\RoomController::class, 'store']);
        Route::get('room', [\App\Http\Controllers\Api\V1\Room\RoomController::class, 'list']);
        Route::get('room/show/{roomId}', [\App\Http\Controllers\Api\V1\Room\RoomController::class, 'show']);
        Route::put('room/update/{roomId}', [\App\Http\Controllers\Api\V1\Room\RoomController::class, 'update']);
        Route::delete('room/delete/{roomId}', [\App\Http\Controllers\Api\V1\Room\RoomController::class, 'delete']);

        Route::post('deck/spell/new', [\App\Http\Controllers\Api\V1\Deck\SpellController::class, 'new']);
        Route::post('deck/spell/clear', [\App\Http\Controllers\Api\V1\Deck\SpellController::class, 'clear']);
        Route::post('deck/spell/handOut', [\App\Http\Controllers\Api\V1\Deck\SpellController::class, 'handOut']);
        Route::get('deck/spell/player-cards/{userId}', [\App\Http\Controllers\Api\V1\Deck\SpellController::class, 'playerCards']);
    });
});
