<?php

namespace App\Deck\Spell;

use App\Models\V1\Deck\SpellCardDeck;
use App\Models\V1\User\UserRoom;
use App\Services\V1\Deck\GameMovesServices;
use App\Services\V1\Infection\InfectionService;

class PilkiiOrgazm extends AbstractSpell
{

    public function action(SpellCardDeck $spellCard, $summRolledDice = null)
    {
        $infectionService = new InfectionService();
        $myUserRoom = $spellCard->room->usersRoom->where('user_id', $spellCard->user_id)->first();
        /** @var UserRoom $enemy */
        $enemy = GameMovesServices::getRightEnemy($myUserRoom);
        if ($summRolledDice < 5) {
            GameMovesServices::makeDamage(-2, $enemy);
        } elseif($summRolledDice < 10) {
            GameMovesServices::makeDamage(-3, $enemy);
        } elseif ($summRolledDice < 31) {
            GameMovesServices::makeDamage(-2, $enemy);
            $infectionService->give($enemy);
        }
    }

    public function getKey()
    {
        return 'pilkii-orgazm';
    }
}
