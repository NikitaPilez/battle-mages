<?php

namespace App\Services\V1\Deck;

use App\Models\V1\User\UserRoom;

class GameMovesServices
{
    public static function makeDamage(int $count, UserRoom $userRoom)
    {
        $userRoom->health_points = $userRoom->health_points - $count;
        $userRoom->save();
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
