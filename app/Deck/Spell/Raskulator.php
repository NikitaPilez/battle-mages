<?php

namespace App\Deck\Spell;

use App\Models\V1\Deck\SpellCardDeck;
use App\Models\V1\User\UserRoom;
use App\Services\V1\Deck\GameMovesServices;
use App\Services\V1\Infection\InfectionService;

class Raskulator extends AbstractSpell
{
    public function action(SpellCardDeck $spellCard, $summRolledDice = null)
    {
        $infectionServices = new InfectionService();
        $enemies = $this->getEnemies($spellCard);
        /** @var UserRoom $enemies */
        foreach ($enemies as $enemy) {
            if ($summRolledDice < 5) {
                GameMovesServices::makeDamage(-1, $enemy);
            } elseif ($summRolledDice < 10) {
                GameMovesServices::makeDamage(-2, $enemy);
            } elseif ($summRolledDice < 31) {
                GameMovesServices::makeDamage(-2, $enemy);
                $infectionServices->give($enemy);
            }
        }
    }

    public function getKey()
    {
        return 'raskulator';
    }

    private function getEnemies(SpellCardDeck $spellCard)
    {
        $userId = $spellCard->user_id;
        $spellCardRoom = $spellCard->room;
        if ($userId === $spellCardRoom->castleOwner?->id) {
            return UserRoom::where('room_id', $spellCard->room_id)->where('user_id', '!=', $spellCard->user_id)->get();
        } else {
            return UserRoom::where('room_id', $spellCardRoom->id)->where('user_id', '!=', $userId)->where('health_points', '>', 9)->get();
        }
    }
}
