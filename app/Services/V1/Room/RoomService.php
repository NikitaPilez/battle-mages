<?php

namespace App\Services\V1\Room;

use App\Models\V1\User\Game;

class RoomService
{
    public function inviteToRoom(int $roomId, array $usersIds)
    {
        foreach ($usersIds as $userId) {
            Game::create([
                'user_id' => $userId,
                'room_id' => $roomId,
                'health_points' => 20,
                'frags' => 0,
                'is_ready' => 0
            ]);
        }
    }
}
