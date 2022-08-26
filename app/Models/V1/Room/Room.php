<?php

namespace App\Models\V1\Room;

use App\Models\V1\User\User;
use App\Models\V1\User\UserRoom;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Room extends Model
{
    use HasFactory;

    public $table = 'rooms';

    public $fillable = [
        'key',
        'status',
        'admin_id',
        'castle_owner_id',
        'position'
    ];

    public function admin(): BelongsTo
    {
        return $this->belongsTo(User::class, 'admin_id');
    }

    public function castleOwner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'castle_owner_id');
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'users_rooms');
    }

    public function usersRoom(): HasMany
    {
        return $this->hasMany(UserRoom::class);
    }
}
