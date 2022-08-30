<?php

namespace App\Deck\Spell;

use App\Models\V1\Deck\SpellCardDeck;
use App\Models\V1\Infection\InfectionCardDeck;
use App\Models\V1\User\UserRoom;
use App\Services\V1\Infection\InfectionService;

class Strupnii extends AbstractSpell
{

    public function action(SpellCardDeck $spellCard, $summRolledDice = null)
    {
        $infectionService = new InfectionService();
        /** @var UserRoom $enemy */
        $enemy = UserRoom::where('room_id', $spellCard->room_id)->where('user_id', '!=', $spellCard->user_id)->orderBy('health_points', 'DESC')->first();
        $countEnemyInfections = InfectionCardDeck::userInfections($enemy->user_id, $enemy->room_id)->count();
        if ($countEnemyInfections === 0) {
            $infectionService->give($enemy);
        } else {
            for ($i = 0; $i < $countEnemyInfections; $i++) {
                $infectionService->give($enemy);
            }
        }
    }

    public function getKey()
    {
        return 'strupnii';
    }
}
