<?php

namespace App\Deck\Spell;

use App\Models\V1\Deck\SpellCardDeck;
use App\Models\V1\Infection\InfectionCardDeck;
use App\Models\V1\User\UserRoom;
use App\Services\V1\Deck\GameMovesServices;

class Poddatenkii extends AbstractSpell
{

    public function action(SpellCardDeck $spellCard, $summRolledDice = null)
    {
        /** @var UserRoom $myUserRoom */
        $myUserRoom = $spellCard->room->usersRoom->where('user_id', $spellCard->user_id)->first();
        !$myUserRoom->canHealthGrow() ?: GameMovesServices::makeDamage(3, $myUserRoom);
        InfectionCardDeck::userInfections($myUserRoom->user_id, $myUserRoom->room_id)->count() > 0 ?: GameMovesServices::takeCastle($myUserRoom);
    }

    public function getKey()
    {
        return 'poddatenkii';
    }
}
