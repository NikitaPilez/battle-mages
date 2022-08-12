<?php

namespace App\Models\V1\Deck;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpellCardDeck extends Model
{
    use HasFactory;

    const AVAILABLE_AMOUNT_ON_HAND = 8;

    public $table = 'spell_card_deck';

    public function scopeSpellsDeck($query, int $roomId)
    {
        return $query->where('status', 'deck')->where('user_id', null)->where('room_id', '=', $roomId);
    }

    public function scopeUserSpells($query, int $userId, int $roomId)
    {
        return $query->where('user_id', '=', $userId)->where('room_id', '=', $roomId);
    }
}
