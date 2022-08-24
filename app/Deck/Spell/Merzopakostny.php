<?php

namespace App\Deck\Spell;

use App\Models\V1\Deck\SpellCardDeck;
use App\Services\V1\Deck\GameMovesServices;
use App\Services\V1\Infection\InfectionService;

class Merzopakostny extends AbstractSpell
{
    public function action(int $spellCardDeckId, $summRolledDice = null)
    {
        $infectionService = new InfectionService();
        $spellCard = SpellCardDeck::findOrFail($spellCardDeckId);
        foreach($spellCard->room->usersRoom as $userRoom) {
            $userInfections = $infectionService->getPlayerInfections($userRoom->user->id, $userRoom->room->id);
            if ($userInfections->count() > 1) {
                GameMovesServices::makeDamage(4, $userRoom);
            }
        }
    }

    public function getKey()
    {
        return 'merzopakostniy';
    }
}
