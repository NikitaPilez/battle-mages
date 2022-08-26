<?php

namespace App\Models\V1\User;

use App\Models\V1\Room\Damages;
use App\Models\V1\Room\Room;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\Pivot;

class UserRoom extends Pivot
{
    use HasFactory;

    protected $table = 'users_rooms';

    CONST START_HEALTH = 20;

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
}
