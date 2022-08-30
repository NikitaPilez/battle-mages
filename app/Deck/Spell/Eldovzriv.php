<?php

namespace App\Deck\Spell;

use App\Models\V1\Deck\SpellCardDeck;
use App\Models\V1\Infection\InfectionCardDeck;
use App\Models\V1\User\UserRoom;
use App\Services\V1\Deck\GameMovesServices;
use App\Services\V1\Infection\InfectionService;

class Eldovzriv extends AbstractSpell
{
    public function action(SpellCardDeck $spellCard, $summRolledDice = null)
    {
        $infectionServices = new InfectionService();
        $myUserRoom = $spellCard->room->usersRoom->where('user_id', $spellCard->user_id)->first();
        /** @var UserRoom $enemy */
        $enemy = GameMovesServices::getLeftEnemy($myUserRoom);
        if ($summRolledDice < 5) {
            GameMovesServices::makeDamage(-1, $enemy);
        } elseif ($summRolledDice < 10) {
            GameMovesServices::makeDamage(-1, $enemy);
            $infectionServices->give($enemy);
        } elseif ($summRolledDice < 31) {
            $countUserInfections = InfectionCardDeck::userInfections($myUserRoom->user_id, $myUserRoom->room_id)->count();
            GameMovesServices::makeDamage(-2 * $countUserInfections, $enemy);
        }
    }

    public function getKey()
    {
        return 'eldovzriv';
    }
}
