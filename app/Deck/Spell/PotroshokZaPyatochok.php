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
        $infectionServices = new InfectionService();
        $victimsRoom = $this->getVictims($spellCard);
        $myInfections = $infectionServices->getPlayerInfections($spellCard->user_id, $spellCard->room_id);

        /** @var UserRoom $victimsRoom */
        foreach ($victimsRoom as $victim) {
            if ($summRolledDice < 5) {
                GameMovesServices::makeDamage(-2, $victim);
            } elseif ($summRolledDice < 10) {
                $infectionServices->give($victim->user_id, $victim->room_id);
            } elseif ($summRolledDice < 31) {
                GameMovesServices::makeDamage(-2 * $myInfections->count(), $victim);
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

    private function getVictims(SpellCardDeck $spellCard)
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
