<?php

namespace App\Deck\Spell;

use App\Deck\CardsMarkEnum;
use App\Deck\CardsTypeEnum;

class OtInkolduni extends AbstractSpell
{
    public function action(int $spellCardDeckId, $summRolledDice = null)
    {

    }

    public function getKey()
    {
        return 'ot-inkolduni';
    }
}
