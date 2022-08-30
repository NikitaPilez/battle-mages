<?php

namespace App\Deck\Spell;

use App\Models\V1\Deck\SpellCardDeck;
use App\Models\V1\Infection\InfectionCardDeck;
use App\Models\V1\User\UserRoom;
use App\Services\V1\Deck\GameMovesServices;
use App\Services\V1\Infection\InfectionService;

class PotroshokZaPyatochok extends AbstractSpell
{
    public function action(SpellCardDeck $spellCard, $summRolledDice = null)
    {
        $infectionServices = new InfectionService();
        $enemies = $this->getEnemies($spellCard);
        $myUserRoom = $spellCard->room->usersRoom->where('user_id', $spellCard->user_id)->first();
        $countMyInfections = InfectionCardDeck::userInfections($myUserRoom->user_id, $myUserRoom->room_id)->count();
        /** @var UserRoom $enemies */
        foreach ($enemies as $enemy) {
            if ($summRolledDice < 5) {
                GameMovesServices::makeDamage(-2, $enemy);
            } elseif ($summRolledDice < 10) {
                $infectionServices->give($enemy);
            } elseif ($summRolledDice < 31) {
                GameMovesServices::makeDamage(-2 * $countMyInfections, $enemy);
            }
        }

        if ($summRolledDice < 5) {
            $infectionServices->give($spellCard->user_id, $spellCard->room_id);
        }

    }

    public function getKey()
    {
        return 'potroshok-za-pyatochok';
    }

    private function getEnemies(SpellCardDeck $spellCard)
    {
        $userId = $spellCard->user_id;
        $spellCardRoom = $spellCard->room;
        if ($userId === $spellCardRoom->castleOwner?->id) {
            return UserRoom::where('room_id', $spellCard->room_id)->where('user_id', '!=', $spellCard->user_id)->get();
        } else {
            $myUserGame = $spellCardRoom->usersRoom->where('user_id', $userId)->first();
            return UserRoom::where('room_id', $spellCardRoom->id)->where('user_id', '!=', $userId)->where('health_points', '<', $myUserGame->health_points)->get();
        }
    }
}
