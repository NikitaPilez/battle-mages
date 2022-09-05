<?php

namespace App\Actions\Game;

use App\Models\V1\Infection\InfectionCardDeck;
use App\Models\V1\User\UserRoom;
use App\Services\V1\Deck\GameMovesServices;

class SuddenlyAction
{
    public static function execute(UserRoom $userRoom)
    {
        InfectionCardDeck::userInfections($userRoom->user_id, $userRoom->room_id)->each(function (InfectionCardDeck $infectionCard) use ($userRoom) {
            $infectionCard->cureInfection();
            GameMovesServices::makeDamage(1, $userRoom);
        });

    }
}
