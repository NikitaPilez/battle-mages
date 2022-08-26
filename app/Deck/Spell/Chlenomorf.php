<?php

namespace App\Deck\Spell;

use App\Models\V1\Deck\SpellCardDeck;
use App\Models\V1\User\UserRoom;
use App\Services\V1\Deck\GameMovesServices;
use App\Services\V1\Infection\InfectionService;

class Chlenomorf extends AbstractSpell
{
    public function action(int $spellCardDeckId, $summRolledDice = null)
    {
        $infectionServices = new InfectionService();
        $spellCard = SpellCardDeck::findOrFail($spellCardDeckId);
        $myUserRoom = $spellCard->room->usersRoom->where('user_id', $spellCard->user_id)->first();
        /** @var UserRoom $enemy */
        $enemy = GameMovesServices::getRightEnemy($myUserRoom);
        if ($summRolledDice < 5) {
            $infectionServices->give($enemy);
        } elseif ($summRolledDice < 10) {
            GameMovesServices::makeDamage(-2, $enemy);
        } elseif ($summRolledDice < 31) {
            $infectionServices->give($enemy);
            $infectionServices->give($enemy);
        }
    }

    public function getKey()
    {
        return 'chlenomorf';
    }
}
