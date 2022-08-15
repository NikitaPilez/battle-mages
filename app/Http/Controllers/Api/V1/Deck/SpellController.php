<?php

namespace App\Http\Controllers\Api\V1\Deck;

use App\Http\Controllers\Api\V1\BaseController;
use App\Http\Resources\V1\Spells\SpellCardDeckCollection;
use App\Models\V1\Deck\SpellCardDeck;
use App\Services\V1\Deck\SpellServices;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SpellController extends BaseController
{
    public function new(Request $request, SpellServices $spellServices): JsonResponse
    {
        $spellCardDecks = $spellServices->newDeck($request->input('room_id'));
        return $this->sendResponse($spellCardDecks);
    }

    public function clear(Request $request, SpellServices $spellServices): JsonResponse
    {
        $spellServices->clearDeckByRoom($request->input('room_id'));
        return $this->sendResponse(message: 'success');
    }

    public function playerCards(int $userId): JsonResponse
    {
        return response()->json(new SpellCardDeckCollection(SpellCardDeck::where('user_id', $userId)->paginate()));
    }

    public function handOut(Request $request, SpellServices $spellServices): JsonResponse
    {
        $roomId = $request->input('room_id');
        $spellServices->handOut($roomId);
        return $this->sendResponse(message: 'success');
    }
}
