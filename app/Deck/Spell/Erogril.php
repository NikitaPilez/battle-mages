<?php

namespace App\Deck\Spell;

use App\Models\V1\Deck\SpellCardDeck;

class Erogril extends AbstractSpell
{
    public function action(SpellCardDeck $spellCard, $summRolledDice = null)
    {
        // левый враг, 1-4 ты берешь 1 сокровище, 5-9 2 урона, 10+ 2 урона за каждое твое зпмп
    }

    public function getKey()
    {
        return 'erogril';
    }
}
