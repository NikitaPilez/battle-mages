<?php

namespace App\Services\V1\Infection;

use App\Models\V1\Infection\Infection;
use App\Models\V1\Infection\InfectionCardDeck;
use App\Models\V1\User\UserRoom;

class InfectionService
{
    public function newDeck(int $roomId)
    {
        InfectionCardDeck::where('room_id', $roomId)->delete();
        $infectionCardDecks = collect();
        $infections = Infection::all();
        foreach ($infections as $infection) {
            $repeat = $infection->repeat;
            for ($i = 0; $i < $repeat; $i++) {
                $infectionCardDeck = new InfectionCardDeck();
                $infectionCardDeck->room_id = $roomId;
                $infectionCardDeck->infection_id = $infection->id;
                $infectionCardDeck->status = 'deck';
                $infectionCardDeck->save();
                $infectionCardDecks->push($infectionCardDeck);
            }
        }

        return $infectionCardDecks;
    }

    public function give(UserRoom $userRoom, $infectionCardDeckId = null): InfectionCardDeck
    {
        if ($infectionCardDeckId !== null) {
            /** @var InfectionCardDeck $infectionCard */
            $infectionCard = InfectionCardDeck::findOrFail($infectionCardDeckId);
        } else {
            /** @var InfectionCardDeck $infectionCard */
            $infectionCard = InfectionCardDeck::where('room_id', $userRoom->room_id)->where('status', 'deck')->get()->random(1)->first();
        }
        $infectionCard->user_id = $userRoom->user_id;
        $infectionCard->status = 'on-hands';
        $infectionCard->save();
        return $infectionCard;
    }

    public function revoke(int $infectionCardDeckId)
    {
        $infectionCardDeck = InfectionCardDeck::findOrFail($infectionCardDeckId);
        $infectionCardDeck->user_id = null;
        $infectionCardDeck->status = 'deck';
        $infectionCardDeck->save();
    }
}
