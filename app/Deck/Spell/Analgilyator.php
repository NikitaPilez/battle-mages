<?php

namespace App\Deck\Spell;

use App\Models\V1\Deck\SpellCardDeck;
use App\Models\V1\User\UserRoom;
use App\Services\V1\Deck\GameMovesServices;
use App\Services\V1\Infection\InfectionService;

class Analgilyator extends AbstractSpell
{
    public function action(int $spellCardDeckId, $summRolledDice = null)
    {
        $infectionServices = new InfectionService();
        $spellCard = SpellCardDeck::findOrFail($spellCardDeckId);
        $myUserRoom = $spellCard->room->usersRoom->where('user_id', $spellCard->user_id)->first();
        /** @var UserRoom $enemy */
        $enemy = GameMovesServices::getLeftEnemy($myUserRoom);
        if ($summRolledDice < 5) {
            GameMovesServices::makeDamage(-2, $enemy);
        } elseif ($summRolledDice < 10) {
            GameMovesServices::makeDamage(-3, $enemy);
            // get jewel
        } elseif ($summRolledDice < 31) {
            $myInfections = $infectionServices->getPlayerInfections($spellCard->user_id, $spellCard->room_id);
            GameMovesServices::makeDamage(-2 * $myInfections->count(), $enemy);
        }
    }

    public function getKey()
    {
        return 'analgilyator';
    }
}
