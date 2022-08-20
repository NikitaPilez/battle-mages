<?php

namespace App\Deck\Spell;

use App\Models\V1\Deck\SpellCardDeck;
use App\Models\V1\User\Game;
use App\Services\V1\Deck\GameMovesServices;

class Merzopakostny extends AbstractSpell
{
    public function action(int $spellCardDeckId)
    {
        $spellCardDeck = SpellCardDeck::findOrFail($spellCardDeckId);
        $usersGame = Game::where('room_id', $spellCardDeck->room->id)->get();
        foreach($usersGame as $userGame) {
            GameMovesServices::makeDamage(4, $userGame);
        }
    }

    public function getKey()
    {
        return 'merzopakostniy';
    }
}
