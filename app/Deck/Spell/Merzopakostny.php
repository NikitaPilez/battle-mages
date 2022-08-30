<?php

namespace App\Deck\Spell;

use App\Models\V1\Deck\SpellCardDeck;
use App\Models\V1\Infection\InfectionCardDeck;
use App\Services\V1\Deck\GameMovesServices;

class Merzopakostny extends AbstractSpell
{
    public function action(SpellCardDeck $spellCard, $summRolledDice = null)
    {
        foreach($spellCard->room->usersRoom as $userRoom) {
            $countUserInfections = InfectionCardDeck::userInfections($userRoom->user_id, $userRoom->room_id)->count();
            if ($countUserInfections > 1) {
                GameMovesServices::makeDamage(-4, $userRoom);
            }
        }
    }

    public function getKey()
    {
        return 'merzopakostniy';
    }
}
