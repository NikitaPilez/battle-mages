<?php

namespace App\Models\V1\Room;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Damages extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_room_id',
        'health_before',
        'health_after',
        'amount',
        'comment'
    ];
}
