<?php

namespace App\Services\V1\Deck;

use App\Models\User;
use App\Models\V1\Deck\Spell;
use App\Models\V1\Deck\SpellCardDeck;
use Illuminate\Database\Eloquent\Collection;

class SpellServices
{
    public function newDeck(int $roomId)
    {
        $this->clearDeckByRoom($roomId);
        $spellCardDecks = collect();
        $spells = Spell::all();
        foreach ($spells as $spell) {
            $repeat = $spell->repeat;
            for ($i = 0; $i < $repeat; $i++) {
                $spellCardDeck = new SpellCardDeck();
                $spellCardDeck->room_id = $roomId;
                $spellCardDeck->spell_id = $spell->id;
                $spellCardDeck->status = 'deck';
                $spellCardDeck->save();
                $spellCardDecks->push($spellCardDeck);
            }
        }

        return $spellCardDecks;
    }

    public function clearDeckByRoom(int $roomId)
    {
        SpellCardDeck::where('room_id', $roomId)->delete();
    }

    public function handOut(int $roomId)
    {
        /** @var Collection $spellsFromDeck */
        $spellsFromDeck = SpellCardDeck::spellsDeck($roomId)->get();
        $currentRoomUsers = User::where('room_id', '=', $roomId)->get();
        foreach($currentRoomUsers as $user) {
            $countUserSpells = SpellCardDeck::userSpells($user->id, $roomId)->count();
            $countNeedCardReceiving = SpellCardDeck::AVAILABLE_AMOUNT_ON_HAND - $countUserSpells;
            for ($i = 0; $i < $countNeedCardReceiving; $i++) {
                if (!$spellsFromDeck->isEmpty()) {
                    $spellItem = $spellsFromDeck->pop();
                    $spellItem->user_id = $user->id;
                    $spellItem->status = 'on-hands';
                    $spellItem->save();
                }
            }
        }
    }
}
