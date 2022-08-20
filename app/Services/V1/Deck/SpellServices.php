<?php

namespace App\Services\V1\Deck;

use App\Deck\Spell\Deck;
use App\Http\Resources\V1\Spells\SpellCardDeckCollection;
use App\Http\Resources\V1\Spells\SpellCardDeckResource;
use App\Models\V1\Deck\Spell;
use App\Models\V1\Deck\SpellCardDeck;
use App\Models\V1\User\Game;
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
        $usersGame = Game::where('room_id', '=', $roomId)->get();
        foreach($usersGame as $userGame) {
            $countUserSpells = SpellCardDeck::userSpells($userGame->user->id, $roomId)->count();
            $countNeedCardReceiving = SpellCardDeck::AVAILABLE_AMOUNT_ON_HAND - $countUserSpells;
            for ($i = 0; $i < $countNeedCardReceiving; $i++) {
                if (!$spellsFromDeck->isEmpty()) {
                    $spellItem = $spellsFromDeck->pop();
                    $spellItem->user_id = $userGame->user->id;
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

    public function makeReadyToGo(int $userId, int $roomId)
    {
        $userGame = Game::where('user_id', $userId)->where('room_id', $roomId)->first();
        $spellCardDeck = SpellCardDeck::where('user_id', $userGame->user->id)->where('room_id', $userGame->room->id)->where('status', '=', 'ready')->get();
        if (!$spellCardDeck->count() > 3) {
            $userGame->is_ready = 1;
            $userGame->save();
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

    public function rollDice(int $count): array
    {
        $values = [];
        for($i = 0; $i < $count; $i++) {
            $values[] = rand(1, 6);
        }
        return $values;
    }

    public function playCard(int $spellCardDeckId)
    {
        $spellCardDeck = SpellCardDeck::findOrFail($spellCardDeckId);
        $obj = Deck::defineSpellByKey($spellCardDeck->spell->key);
        $obj->action($spellCardDeckId);
    }
}
