<?php

namespace App\Deck\Spell;

use App\Models\V1\Deck\SpellCardDeck;
use App\Models\V1\User\UserRoom;
use App\Services\V1\Deck\GameMovesServices;
use App\Services\V1\Infection\InfectionService;

class ZlakManyak extends AbstractSpell
{
    public function action(SpellCardDeck $spellCard, $summRolledDice = null)
    {
        $infectionService = new InfectionService();
        $enemies = $this->getEnemies($spellCard);
        if ($summRolledDice < 5) {
            $myUserRoom = $spellCard->room->usersRoom->where('user_id', $spellCard->user_id)->first();
            GameMovesServices::makeDamage(-2, $myUserRoom);
        } elseif ($summRolledDice < 10) {
            foreach($enemies as $enemy) {
                GameMovesServices::makeDamage(-2, $enemy);
            }
        } elseif ($summRolledDice < 31) {
            foreach($enemies as $enemy) {
                $infectionService->give($enemy);
            }
            $spellCard->stay();
        }
    }

    public function getKey()
    {
        return 'zlak-manyak';
    }

    private function getEnemies(SpellCardDeck $spellCard)
    {
        return UserRoom::where('room_id', $spellCard->room_id)->where('user_id', '!=', $spellCard->user_id)->get();
    }
}
