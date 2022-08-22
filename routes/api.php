<?php

use App\Http\Controllers\Api\V1\Deck\SpellController;
use App\Http\Controllers\Api\V1\Infection\InfectionController;
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

//    Route::middleware('auth:sanctum')->group(function () {
        Route::controller(RoomController::class)->group(function() {
            Route::get('room', 'list');
            Route::post('room/invite', 'invite');
            Route::post('room/store', 'store');
            Route::get('room/show/{roomId}', 'show');
            Route::put('room/update/{roomId}', 'update');
            Route::delete('room/delete/{roomId}', 'delete');
        });

        Route::controller(SpellController::class)->group(function() {
            Route::post('deck/spell/new', 'new');
            Route::post('deck/spell/handOut', 'handOut');
            Route::post('deck/spell/changeStatus', 'changeStatus');
            Route::get('deck/spell/player-cards', 'playerSpells');
            Route::post('deck/spell/ready-to-go', 'readyToGo');
            Route::get('deck/spell/roll-dice', 'rollDice');
            Route::get('deck/spell/play-card', 'playCard');
        });

        Route::controller(InfectionController::class)->group(function() {
            Route::post('deck/infection/new', 'new');
            Route::post('deck/infection/give', 'give');
            Route::post('deck/infection/revoke', 'revoke');
            Route::get('deck/infection/get-user-cards', 'getUserInfections');
        });
//    });
});
