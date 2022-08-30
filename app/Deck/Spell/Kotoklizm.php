<?php

namespace App\Deck\Spell;

use App\Models\V1\Deck\SpellCardDeck;
use App\Models\V1\Infection\InfectionCardDeck;
use App\Models\V1\User\UserRoom;
use App\Services\V1\Deck\GameMovesServices;

class Kotoklizm extends AbstractSpell
{

    public function action(SpellCardDeck $spellCard, $summRolledDice = null)
    {
        /** @var UserRoom $myUserRoom */
        $myUserRoom = $spellCard->room->usersRoom->where('user_id', $spellCard->user_id)->first();
        if ($summRolledDice < 5) {
            // cure infection
        } elseif($summRolledDice < 10) {
            $myUserRoom->canHealthGrow() ? GameMovesServices::makeDamage(3, $myUserRoom) : '';
        } elseif ($summRolledDice < 31) {
            InfectionCardDeck::userInfections($myUserRoom->user_id, $myUserRoom->room_id)->each(function ($item, $key) {
                /** @var InfectionCardDeck $item */
                $item->cureInfection();
            });
        }
    }

    public function getKey()
    {
        return 'kotoklizm';
    }
}
