<?php

namespace App\Actions\Room;

use App\Models\V1\User\UserRoom;

class InviteToRoomAction
{
    public function execute(int $roomId, array $usersIds)
    {
        $position = 1;
        foreach ($usersIds as $userId) {
            UserRoom::create([
                'user_id' => $userId,
                'room_id' => $roomId,
                'health_points' => UserRoom::START_HEALTH,
                'frags' => 0,
                'is_ready' => 0,
                'position' => $position
            ]);
            $position++;
        }
    }
}
