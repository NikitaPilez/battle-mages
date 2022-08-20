<?php

namespace App\Models\V1\Room;

use App\Models\V1\User\Game;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    public $table = 'rooms';

    public $fillable = ['key', 'status', 'admin_id', 'castle_owner_id'];

    public function admin()
    {
        return $this->belongsTo(Game::class, 'admin_id');
    }
}
