<?php

namespace App\Deck\Spell;

use App\Models\V1\Deck\SpellCardDeck;
use App\Models\V1\User\UserRoom;
use App\Services\V1\Deck\GameMovesServices;
use App\Services\V1\Infection\InfectionService;

class PotroshokZaPyatochok extends AbstractSpell
{
    public function action(int $spellCardDeckId, $summRolledDice = null)
    {
        $spellCard = SpellCardDeck::findOrFail($spellCardDeckId);
        $spellCardUser = $spellCard->user;
        $spellCardRoom = $spellCard->room;
        $infectionServices = new InfectionService();
        $victimsRoom = $this->getVictims($spellCard);
        $myInfections = $infectionServices->getPlayerInfections($spellCardUser->id, $spellCardRoom->id);

        /** @var UserRoom $victimsRoom */
        foreach ($victimsRoom as $victim) {
            if ($summRolledDice < 5) {
                GameMovesServices::makeDamage(2, $victim);
            } elseif ($summRolledDice < 10) {
                $infectionServices->give($victim->user->id, $victim->room->id);
            } elseif ($summRolledDice < 30) {
                GameMovesServices::makeDamage(2 * $myInfections->count(), $victim);
            }
        }

        if ($summRolledDice < 5) {
            $infectionServices->give($spellCardUser->id, $spellCardRoom->id);
        }

    }

    public function getKey()
    {
        return 'potroshok-za-pyatochok';
    }

    private function getVictims(SpellCardDeck $spellCard)
    {
        $spellCardUser = $spellCard->user;
        $spellCardRoom = $spellCard->room;
        if ($spellCardUser->id === $spellCardRoom->castleOwner?->id) {
            return UserRoom::where('room_id', $spellCardRoom->id)->where('user_id', '!=', $spellCardUser->id)->get();
        } else {
            $myUserGame = $spellCardRoom->usersRoom->where('user_id', $spellCardUser->id)->first();
            return UserRoom::where('room_id', $spellCardRoom->id)->where('user_id', '!=', $spellCardUser->id)->where('health_points', '<', $myUserGame->health_points)->get();
        }
    }
}
