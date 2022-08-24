<?php

namespace App\Models\V1\Room;

use App\Models\V1\User\User;
use App\Models\V1\User\UserRoom;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Room extends Model
{
    use HasFactory;

    public $table = 'rooms';

    public $fillable = ['key', 'status', 'admin_id', 'castle_owner_id'];

    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }

    public function castleOwner()
    {
        return $this->belongsTo(User::class, 'castle_owner_id');
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'users_rooms');
    }

    public function usersRoom()
    {
        return $this->hasMany(UserRoom::class);
    }
}
