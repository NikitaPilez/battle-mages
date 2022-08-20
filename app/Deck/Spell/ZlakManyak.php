<?php

namespace App\Deck\Spell;

use App\Deck\CardsMarkEnum;
use App\Deck\CardsTypeEnum;
use App\Models\V1\Deck\SpellCardDeck;
use App\Models\V1\User\Game;
use App\Services\V1\Deck\GameMovesServices;

class ZlakManyak extends AbstractSpell
{
    public function action(int $spellCardDeckId, $summRolledDice = 0)
    {
        $spellCardDeck = SpellCardDeck::findOrFail($spellCardDeckId);
        $usersGame = Game::where('room_id', $spellCardDeck->room->id)->get();
        if ($summRolledDice < 5) {
            GameMovesServices::makeDamage(2, $spellCardDeck->user->id);
        } elseif ($summRolledDice < 10) {
            foreach($usersGame as $userGame) {
                if ($userGame->user->id !== $spellCardDeck->user->id) {
                    GameMovesServices::makeDamage(2, $userGame);
                }
            }
        }
    }

    public function getKey()
    {
        return 'zlak-manyak';
    }
}
