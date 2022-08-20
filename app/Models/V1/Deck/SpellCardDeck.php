<?php

namespace App\Models\V1\Deck;

use App\Models\V1\Room\Room;
use App\Models\V1\User\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpellCardDeck extends Model
{
    use HasFactory;

    const AVAILABLE_AMOUNT_ON_HAND = 8;
    const AVAILABLE_STATUSES = ['deck', 'on-hands', 'ready', 'in-game', 'trash'];

    public $table = 'spell_card_deck';

    public $fillable = ['status'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function spell()
    {
        return $this->belongsTo(Spell::class);
    }

    public function scopeSpellsDeck($query, int $roomId)
    {
        return $query->where('status', 'deck')->where('user_id', null)->where('room_id', $roomId);
    }

    public function scopeUserSpells($query, int $userId, int $roomId)
    {
        return $query->where('user_id', $userId)->where('room_id', $roomId);
    }
}
