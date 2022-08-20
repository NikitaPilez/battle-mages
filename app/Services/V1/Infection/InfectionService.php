<?php

namespace App\Services\V1\Infection;

use App\Models\V1\Infection\Infection;
use App\Models\V1\Infection\InfectionCardDeck;

class InfectionService
{
    public function newDeck(int $roomId)
    {
        $this->clearDeckByRoom($roomId);
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

    public function clearDeckByRoom(int $roomId): void
    {
        InfectionCardDeck::where('room_id', $roomId)->delete();
    }
}
