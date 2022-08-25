<?php

namespace App\Deck\Spell;

use App\Models\V1\Deck\SpellCardDeck;
use App\Models\V1\User\UserRoom;
use App\Services\V1\Deck\GameMovesServices;

class ZlakManyak extends AbstractSpell
{
    public function action(int $spellCardDeckId, $summRolledDice = null)
    {
        $spellCard = SpellCardDeck::findOrFail($spellCardDeckId);
        if ($summRolledDice < 5) {
            $myUserRoom = $spellCard->room->usersRoom->where('user_id', $spellCard->user_id)->first();
            GameMovesServices::makeDamage(2, $myUserRoom);
        } elseif ($summRolledDice < 10) {
            $victims = $spellCard->room->usersRoom;
            foreach($victims as $victim) {
                if ($victim->user_id !== $spellCard->user_id) {
                    GameMovesServices::makeDamage(2, $victim);
                }
            }
        }
    }

    public function getKey()
    {
        return 'zlak-manyak';
    }
}
