<?php

namespace App\Deck\Spell;

use App\Models\V1\Deck\SpellCardDeck;
use App\Services\V1\Deck\GameMovesServices;
use App\Services\V1\Infection\InfectionService;

class Merzopakostny extends AbstractSpell
{
    public function action(SpellCardDeck $spellCard, $summRolledDice = null)
    {
        $infectionService = new InfectionService();
        foreach($spellCard->room->usersRoom as $userRoom) {
            $userInfections = $infectionService->getPlayerInfections($userRoom);
            if ($userInfections->count() > 1) {
                GameMovesServices::makeDamage(-4, $userRoom);
            }
        }
    }

    public function getKey()
    {
        return 'merzopakostniy';
    }
}
