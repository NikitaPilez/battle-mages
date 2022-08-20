<?php

namespace App\Http\Controllers\Api\V1\Deck;

use App\Http\Controllers\Api\V1\BaseController;
use App\Http\Requests\V1\Spell\ChangeStatusRequest;
use App\Http\Requests\V1\Spell\GetPlayerCardsRequest;
use App\Http\Requests\V1\Spell\MakeReadyToGoRequest;
use App\Http\Requests\V1\Spell\NewDeckRequest;
use App\Http\Requests\V1\Spell\PlayCardRequest;
use App\Http\Requests\V1\Spell\RollDiceRequest;
use App\Services\V1\Deck\SpellServices;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SpellController extends BaseController
{
    public function new(NewDeckRequest $request, SpellServices $spellServices): JsonResponse
    {
        $request->validated();
        return $this->sendResponse($spellServices->newDeck($request->input('roomId')));
    }

    public function playerSpells(GetPlayerCardsRequest $request, SpellServices $spellServices): JsonResponse
    {
        $request->validated();
        $playerSpells = $spellServices->getPlayerCards($request->input('userId'), $request->input('status'));
        return response()->json($playerSpells);
    }

    public function handOut(Request $request, SpellServices $spellServices): JsonResponse
    {
        $spellServices->handOut($request->input('roomId'));
        return $this->sendResponse(message: 'success');
    }

    public function changeStatus(ChangeStatusRequest $request, SpellServices $spellServices): JsonResponse
    {
        $request->validated();
        return $this->sendResponse($spellServices->changeSpellStatus($request->input('spellCardDeckId'), $request->input('status')));
    }

    public function readyToGo(MakeReadyToGoRequest $request, SpellServices $spellServices): JsonResponse
    {
        $request->validated();
        $spellServices->makeReadyToGo($request->input('userId'), $request->input('roomId'));
        return $this->sendResponse(message: 'success');
    }

    public function rollDice(RollDiceRequest $request, SpellServices $spellServices): JsonResponse
    {
        $request->validated();
        return $this->sendResponse($spellServices->rollDice($request->input('count')));
    }

    public function playCard(PlayCardRequest $request, SpellServices $spellServices)
    {
        $spellServices->playCard($request->input('spellCardDeckId'));
    }
}
