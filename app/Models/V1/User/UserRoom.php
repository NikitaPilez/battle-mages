<?php

namespace App\Models\V1\User;

use App\Models\V1\Room\Damages;
use App\Models\V1\Room\Room;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Support\Facades\DB;

class UserRoom extends Pivot
{
    use HasFactory;

    public $incrementing = true;
    protected $table = 'users_rooms';

    CONST START_HEALTH = 20;
    CONST AVAILABLE_AMOUNT_ON_HAND = 8;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'room_id',
        'health_points',
        'frags',
        'is_ready'
    ];

    public function room(): BelongsTo
    {
        return $this->belongsTo(Room::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function damages(): HasMany
    {
        return $this->hasMany(Damages::class, 'user_room_id');
    }

    public function allowedCountSpells()
    {
        return $this->getCountMyInfections('kristinka') > 0 ? self::AVAILABLE_AMOUNT_ON_HAND - 2 : self::AVAILABLE_AMOUNT_ON_HAND;
    }

    public function getCountMyInfections(string $key = null)
    {
        $query = DB::table('infection_card_deck')
            ->where('user_id', $this->user_id)
            ->where('room_id', $this->room_id);
        if ($key !== null) {
            $query->join('infections', 'infections.id', '=', 'infection_card_deck.infection_id')->where('key', $key);
        }
        return $query->count();
    }

    public function canHealthGrow(): bool
    {
        $query = DB::table('infection_card_deck')
            ->where('user_id', $this->user_id)
            ->where('room_id', $this->room_id)
            ->join('infections', 'infections.id', '=', 'infection_card_deck.infection_id')
            ->where('key', 'shkoda');
        return $query->count() === 0;
    }
}
