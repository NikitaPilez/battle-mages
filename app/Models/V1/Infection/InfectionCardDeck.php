<?php

namespace App\Models\V1\Infection;

use App\Models\V1\Room\Room;
use App\Models\V1\User\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InfectionCardDeck extends Model
{
    use HasFactory;

    const AVAILABLE_STATUSES = ['deck', 'on-hands'];

    public $table = 'infection_card_deck';

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function infection()
    {
        return $this->belongsTo(Infection::class);
    }
}
