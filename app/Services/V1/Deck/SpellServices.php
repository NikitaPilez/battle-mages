<?php

namespace App\Services\V1\Deck;

use App\Deck\Spell\Deck;
use App\Events\SpellPlayed;
use App\Http\Resources\V1\Spells\SpellCardDeckCollection;
use App\Http\Resources\V1\Spells\SpellCardDeckResource;
use App\Models\V1\Deck\Spell;
use App\Models\V1\Deck\SpellCardDeck;
use App\Models\V1\Room\Room;
use App\Models\V1\User\UserRoom;
use Illuminate\Database\Eloquent\Collection;

class SpellServices
{
    public function newDeck(int $roomId)
    {
        SpellCardDeck::where('room_id', $roomId)->delete();
        $spellCardDecks = collect();
        $spells = Spell::all();
        foreach ($spells as $spell) {
            $repeat = $spell->repeat;
            for ($i = 0; $i < $repeat; $i++) {
                $spellCardDeck = new SpellCardDeck();
                $spellCardDeck->room_id = $roomId;
                $spellCardDeck->spell_id = $spell->id;
                $spellCardDeck->status = 'deck';
                $spellCardDeck->save();
                $spellCardDecks->push($spellCardDeck);
            }
        }

        return $spellCardDecks;
    }

    public function handOut(int $roomId)
    {
        /** @var Collection $spellsFromDeck */
        $spellsFromDeck = SpellCardDeck::spellsDeck($roomId)->get();
        $room = Room::findOrFail($roomId);
        /** @var UserRoom $userRoom */
        foreach($room->usersRoom as $userRoom) {
            $countUserSpells = SpellCardDeck::userSpells($userRoom->user_id, $roomId)->count();
            $countNeedCardReceiving = $userRoom->allowedCountSpells() - $countUserSpells;
            for ($i = 0; $i < $countNeedCardReceiving; $i++) {
                if (!$spellsFromDeck->isEmpty()) {
                    $spellItem = $spellsFromDeck->pop();
                    $spellItem->user_id = $userRoom->id;
                    $spellItem->status = 'on-hands';
                    $spellItem->save();
                }
            }
        }
    }

    public function changeSpellStatus(int $spellCardDeckId, string $status): SpellCardDeckResource
    {
        $spellCardDeck = SpellCardDeck::findOrFail($spellCardDeckId);
        $spellCardDeck->update(['status' => $status]);

        return new SpellCardDeckResource($spellCardDeck);
    }

    public function makeReadyToGo(int $userRoomId)
    {
        $userRoom = UserRoom::findOrFail($userRoomId);
        $spellCardDeck = SpellCardDeck::where('user_id', $userRoom->user->id)->where('room_id', $userRoom->room->id)->where('status', '=', 'ready')->get();
        if ($spellCardDeck->count() < 4) {
            $userRoom->is_ready = 1;
            $userRoom->save();
        }
    }

    public function getPlayerCards(int $userId, int $roomId = null, string $status = null)
    {
        $query = SpellCardDeck::where('user_id', $userId);
        if ($status !== null) {
            $query->where('status', $status);
        }
        if ($roomId !== null) {
            $query->where('room_id', $roomId);
        }
        return new SpellCardDeckCollection($query->get());
    }

    public function rollDice(int $count): array
    {
        $values = [];
        for($i = 0; $i < $count; $i++) {
            $values[] = rand(1, 6);
        }
        return $values;
    }

    public function playCard(SpellCardDeck $spellCard, $summRolledDice = null)
    {
//        $obj = Deck::defineSpellByKey($spellCard->spell->key);
//        $obj->action($spellCard, $summRolledDice);
//        $spellCard->status = 'played';
//        $spellCard->save();
        SpellPlayed::dispatch($spellCard);
    }
}
