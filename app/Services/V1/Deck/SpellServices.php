<?php

namespace App\Services\V1\Deck;

use App\Models\V1\Deck\Spell;
use App\Models\V1\Deck\SpellCardDeck;

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
}
