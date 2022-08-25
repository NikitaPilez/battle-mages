<?php

namespace App\Deck\Spell;

class Erogril extends AbstractSpell
{
    public function action(int $spellCardDeckId, $summRolledDice = null)
    {
        // левый враг, 1-4 ты берешь 1 сокровище, 5-9 2 урона, 10+ 2 урона за каждое твое зпмп
    }

    public function getKey()
    {
        return 'erogril';
    }
}
