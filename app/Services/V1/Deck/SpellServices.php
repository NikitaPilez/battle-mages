<?php

namespace App\Services\V1\Deck;

use App\Http\Resources\V1\Spells\SpellCardDeckCollection;
use App\Http\Resources\V1\Spells\SpellCardDeckResource;
use App\Models\V1\Deck\Spell;
use App\Models\V1\Deck\SpellCardDeck;
use App\Models\V1\User\User;
use Illuminate\Database\Eloquent\Collection;

class SpellServices
{
    public function newDeck(int $roomId)
    {
        $this->clearDeckByRoom($roomId);
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

    public function clearDeckByRoom(int $roomId): void
    {
        SpellCardDeck::where('room_id', $roomId)->delete();
    }

    public function handOut(int $roomId)
    {
        /** @var Collection $spellsFromDeck */
        $spellsFromDeck = SpellCardDeck::spellsDeck($roomId)->get();
        $currentRoomUsers = User::where('room_id', '=', $roomId)->get();
        foreach($currentRoomUsers as $user) {
            $countUserSpells = SpellCardDeck::userSpells($user->id, $roomId)->count();
            $countNeedCardReceiving = SpellCardDeck::AVAILABLE_AMOUNT_ON_HAND - $countUserSpells;
            for ($i = 0; $i < $countNeedCardReceiving; $i++) {
                if (!$spellsFromDeck->isEmpty()) {
                    $spellItem = $spellsFromDeck->pop();
                    $spellItem->user_id = $user->id;
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

    public function makeReadyToGo(int $userId)
    {
        $user = User::findOrFail($userId);
        $spellCardDeck = SpellCardDeck::where('user_id', $user->id)->where('room_id', $user->room->id)->where('status', '=', 'ready')->get();
        if (!$spellCardDeck->count() > 3) {
            $user->is_ready = 1;
            $user->save();
        }
    }

    public function getPlayerCards(int $userId, string $status = null)
    {
        $query = SpellCardDeck::where('user_id', $userId);
        if ($status !== null) {
            $query->where('status', $status);
        }
        return new SpellCardDeckCollection($query->get());
    }
}
