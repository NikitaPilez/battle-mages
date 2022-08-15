<?php

use App\Http\Controllers\Api\V1\Deck\SpellController;
use App\Http\Controllers\Api\V1\Room\RoomController;
use App\Http\Controllers\Api\V1\User\UserController;
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

Route::prefix('v1')->group(function () {

    Route::controller(UserController::class)->group(function(){
        Route::post('register', 'register');
        Route::post('login', 'login');
    });

    Route::middleware('auth:sanctum')->group(function () {
        Route::controller(RoomController::class)->group(function() {
            Route::get('room', 'list');
            Route::post('room/store', 'store');
            Route::get('room/show/{roomId}', 'show');
            Route::put('room/update/{roomId}', 'update');
            Route::delete('room/delete/{roomId}', 'delete');
        });

        Route::controller(SpellController::class)->group(function() {
            Route::post('deck/spell/new', 'new');
            Route::post('deck/spell/clear',  'clear');
            Route::post('deck/spell/handOut', 'handOut');
            Route::get('deck/spell/player-cards/{userId}', 'playerCards');
        });
    });
});
