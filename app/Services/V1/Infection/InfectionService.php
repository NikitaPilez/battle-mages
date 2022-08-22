<?php

namespace App\Services\V1\Infection;

use App\Http\Resources\V1\Infection\InfectionCardDeckCollection;
use App\Models\V1\Infection\Infection;
use App\Models\V1\Infection\InfectionCardDeck;

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

    public function give(int $userId, $infectionCardDeckId = null): InfectionCardDeck
    {
        if ($infectionCardDeckId !== null) {
            /** @var InfectionCardDeck $infectionCard */
            $infectionCard = InfectionCardDeck::findOrFail($infectionCardDeckId);
        } else {
            /** @var InfectionCardDeck $infectionCard */
            $infectionCard = InfectionCardDeck::all()->random(1)->first();
        }
        $infectionCard->user_id = $userId;
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

    public function getPlayerCards(int $userId, int $roomId = null, string $status = null)
    {
        $query = InfectionCardDeck::where('user_id', $userId);
        if ($roomId !== null) {
            $query->where('room_id', $roomId);
        }
        if ($status !== null) {
            $query->where('status', $status);
        }
        return new InfectionCardDeckCollection($query->get());
    }
}
