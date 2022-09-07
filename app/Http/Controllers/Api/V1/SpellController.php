<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\V1\Spell\ChangeStatusRequest;
use App\Http\Requests\V1\Spell\GetPlayerCardsRequest;
use App\Http\Requests\V1\Spell\MakeReadyToGoRequest;
use App\Http\Requests\V1\Spell\NewDeckRequest;
use App\Http\Requests\V1\Spell\PlayCardRequest;
use App\Http\Requests\V1\Spell\RollDiceRequest;
use App\Models\V1\Deck\SpellCardDeck;
use App\Services\V1\Deck\SpellServices;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SpellController extends BaseController
{
    public function new(NewDeckRequest $request, SpellServices $spellServices): JsonResponse
    {
        return $this->sendResponse($spellServices->newDeck($request->input('roomId')));
    }

    public function playerSpells(GetPlayerCardsRequest $request, SpellServices $spellServices): JsonResponse
    {
        $playerSpells = $spellServices->getPlayerCards($request->input('userId'), $request->input('roomId'), $request->input('status'));
        return response()->json($playerSpells);
    }

    public function handOut(Request $request, SpellServices $spellServices): JsonResponse
    {
        $spellServices->handOut($request->input('roomId'));
        return $this->sendResponse(message: 'success');
    }

    public function changeStatus(ChangeStatusRequest $request, SpellServices $spellServices): JsonResponse
    {
        return $this->sendResponse($spellServices->changeSpellStatus($request->input('spellCardDeckId'), $request->input('status')));
    }

    public function readyToGo(MakeReadyToGoRequest $request, SpellServices $spellServices): JsonResponse
    {
        $spellServices->makeReadyToGo($request->input('userRoomId'));
        return $this->sendResponse(message: 'success');
    }

    public function rollDice(RollDiceRequest $request, SpellServices $spellServices): JsonResponse
    {
        return $this->sendResponse($spellServices->rollDice($request->input('count')));
    }

    public function playCard(PlayCardRequest $request, SpellServices $spellServices)
    {
        $spellCard = SpellCardDeck::findOrFail($request->input('spellCardDeckId'));
        $spellServices->playCard($spellCard, $request->input('summRolledDice'));
    }

    public function getUniqueMarks()
    {
        //
    }
}
