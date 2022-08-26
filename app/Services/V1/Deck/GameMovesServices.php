<?php

namespace App\Services\V1\Deck;

use App\Models\V1\Room\Damages;
use App\Models\V1\User\UserRoom;

class GameMovesServices
{
    public static function makeDamage(int $amount, UserRoom $userRoom, string $comment = null)
    {
        $userHealth = $userRoom->getHealth();
        $userRoom->health_points = ($userHealth + $amount);
        $userRoom->save();

        Damages::create([
            'user_room_id' => $userRoom->id,
            'health_before' => $userHealth,
            'health_after' => $userHealth + $amount,
            'amount' => $amount,
            'comment' => $comment
        ]);
    }

    public static function getRightEnemy(UserRoom $userRoom)
    {
        $roomId = $userRoom->room->id;
        $myPosition = $userRoom->position;
        $usersRooms = UserRoom::where('room_id', $roomId)->where('health_points', '>', 0)->pluck('position')->toArray();
        if ($myPosition === min($usersRooms)) {
            return UserRoom::where('room_id', $roomId)->where('position', max($usersRooms))->first();
        } else {
            return UserRoom::where('room_id', $roomId)->where('health_points', '>', 0)->where('position', '<', $myPosition)->orderBy('position', 'DESC')->first();
        }
    }

    public static function getLeftEnemy(UserRoom $userRoom)
    {
        $roomId = $userRoom->room->id;
        $myPosition = $userRoom->position;
        $usersRooms = UserRoom::where('room_id', $roomId)->where('health_points', '>', 0)->pluck('position')->toArray();
        if ($myPosition === max($usersRooms)) {
            return UserRoom::where('room_id', $roomId)->where('position', min($usersRooms))->first();
        } else {
            return UserRoom::where('room_id', $roomId)->where('health_points', '>', 0)->where('position', '>', $myPosition)->orderBy('position', 'ASC')->first();
        }
    }
}
