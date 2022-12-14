<?php

namespace App\Models\V1\Deck;

use App\Models\V1\Room\Room;
use App\Models\V1\User\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SpellCardDeck extends Model
{
    use HasFactory;

    const AVAILABLE_STATUSES = ['deck', 'on-hands', 'ready', 'played', 'in-game', 'trash'];

    public $table = 'spell_card_deck';

    public $fillable = [
        'spell_id',
        'room_id',
        'user_id',
        'is_stand',
        'status'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function room(): BelongsTo
    {
        return $this->belongsTo(Room::class);
    }

    public function spell(): BelongsTo
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

    public function stay()
    {
        $this->is_stand = 1;
        $this->save();
    }
}
