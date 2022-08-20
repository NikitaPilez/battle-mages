<?php

namespace App\Services\V1\Deck;

use App\Models\V1\Deck\SpellCardDeck;
use App\Models\V1\User\Game;

class GameMovesServices
{
    public static function getWizardByParams($countInfection = 0)
    {
        $query = SpellCardDeck::query();
    }

    public static function makeDamage(int $count, Game $userGame)
    {
        $userGame->health_points = $userGame->health_points - $count;
        $userGame->save();
    }
}
