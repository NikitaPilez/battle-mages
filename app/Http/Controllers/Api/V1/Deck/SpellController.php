<?php

namespace App\Http\Controllers\Api\V1\Deck;

use App\Http\Controllers\Controller;
use App\Services\V1\Deck\SpellServices;
use Illuminate\Http\Request;

class SpellController extends Controller
{
    public function new(Request $request, SpellServices $spellServices)
    {
        $spellCardDecks = $spellServices->newDeck($request->input('room_id'));
        return response()->json(['data' => $spellCardDecks]);
    }

    public function clear(Request $request, SpellServices $spellServices)
    {
        $spellServices->clearDeckByRoom($request->input('room_id'));

        return response()->json(true);
    }

    public function list()
    {

    }

    public function handOut(Request $request, SpellServices $spellServices)
    {
        $spellServices->handOut($request->input('room_id'));
    }
}
