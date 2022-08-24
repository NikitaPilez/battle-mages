<?php

namespace App\Services\V1\Deck;

use App\Models\V1\Deck\SpellCardDeck;
use App\Models\V1\User\UserRoom;

class GameMovesServices
{
    public static function getWizardByParams($countInfection = 0)
    {
        $query = SpellCardDeck::query();
    }

    public static function makeDamage(int $count, UserRoom $userRoom)
    {
        $userRoom->health_points = $userRoom->health_points - $count;
        $userRoom->save();
    }
}
