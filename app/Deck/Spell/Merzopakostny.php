<?php

namespace App\Deck\Spell;

use App\Actions\Game\SuddenlyAction;
use App\Models\V1\Deck\SpellCardDeck;
use App\Models\V1\Infection\InfectionCardDeck;
use App\Services\V1\Deck\GameMovesServices;

class Merzopakostny extends AbstractSpell
{
    public function action(SpellCardDeck $spellCard, $summRolledDice = null)
    {
        $myUserRoom = $spellCard->room->usersRoom->where('user_id', $spellCard->user_id)->first();
        if ($myUserRoom->health_points > 0) {
            foreach($spellCard->room->usersRoom as $userRoom) {
                $countUserInfections = InfectionCardDeck::userInfections($userRoom->user_id, $userRoom->room_id)->count();
                if ($countUserInfections > 1) {
                    GameMovesServices::makeDamage(-4, $userRoom);
                }
            }
        } else {
            SuddenlyAction::execute($myUserRoom);
        }
    }

    public function getKey()
    {
        return 'merzopakostniy';
    }
}
