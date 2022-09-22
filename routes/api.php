<?php

use App\Http\Controllers\Api\V1\VerifyEmailController;
use App\Http\Controllers\Api\V1\InfectionController;
use App\Http\Controllers\Api\V1\RoomController;
use App\Http\Controllers\Api\V1\SpellController;
use App\Http\Controllers\Api\V1\UserController;
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
        Route::post('users/register', 'register');
        Route::post('users/login', 'login');
        Route::get('users/{user}', 'user');
        Route::get('/verify-email/{id}/{hash}', 'verify')
            ->middleware(['signed', 'throttle:6,1'])->name('verification.verify');
    });

//    Route::middleware('auth:sanctum')->group(function () {
        Route::controller(RoomController::class)->group(function() {
            Route::get('rooms', 'list');
            Route::post('rooms/invite', 'invite');
            Route::post('rooms/store', 'store');
            Route::get('rooms/show/{room}', 'show');
            Route::put('rooms/update/{room}', 'update');
            Route::delete('rooms/delete/{room}', 'delete');
        });

        Route::controller(SpellController::class)->group(function() {
            Route::post('spells/new', 'new');
            Route::post('spells/handOut', 'handOut');
            Route::post('spells/changeStatus', 'changeStatus');
            Route::get('spells/player-cards', 'playerSpells');
            Route::post('spells/ready-to-go', 'readyToGo');
            Route::get('spells/roll-dice', 'rollDice');
            Route::get('spells/play-card', 'playCard');
        });

        Route::controller(InfectionController::class)->group(function() {
            Route::post('infections/new', 'new');
            Route::post('infections/give', 'give');
            Route::post('infections/revoke/{infectionCardDeck}', 'revoke');
            Route::get('infections/get-user-cards', 'getUserInfections');
        });
//    });
});
