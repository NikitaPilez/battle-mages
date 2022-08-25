<?php

namespace App\Deck\Spell;

use App\Deck\CardsMarkEnum;
use App\Deck\CardsTypeEnum;

class OtInkolduni extends AbstractSpell
{
    public function action(int $spellCardDeckId, $summRolledDice = null)
    {
        // каждый враг заражается одним зпмп за каждое свое сокровище если ни у кого нет сокровищ, возьми одно сокровище
    }

    public function getKey()
    {
        return 'ot-inkolduni';
    }
}
