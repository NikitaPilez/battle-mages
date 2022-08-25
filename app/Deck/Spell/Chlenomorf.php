<?php

namespace App\Deck\Spell;

class Chlenomorf extends AbstractSpell
{

    public function action(int $spellCardDeckId, $summRolledDice = null)
    {
        // правый враг, 1-4 зпмп 5-9 2 урона 10+ 2 зпмп
    }

    public function getKey()
    {
        return 'chlenomorf';
    }
}
