<?php

namespace App\Http\Controllers\Api\V1\Deck;

use App\Http\Controllers\Api\V1\BaseController;
use App\Http\Requests\V1\Spell\ChangeStatusRequest;
use App\Http\Requests\V1\Spell\MakeReadyToGoRequest;
use App\Http\Requests\V1\Spell\NewDeckRequest;
use App\Http\Resources\V1\Spells\SpellCardDeckCollection;
use App\Models\V1\Deck\SpellCardDeck;
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

    public function playerSpells(int $userId): JsonResponse
    {
        return response()->json(new SpellCardDeckCollection(SpellCardDeck::where('user_id', $userId)->get()));
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
        $spellServices->makeReadyToGo($request->input('userId'));
        return $this->sendResponse(message: 'success');
    }
}
