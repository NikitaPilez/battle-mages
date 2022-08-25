<?php

namespace App\Deck\Spell;

class Gigazip extends AbstractSpell
{

    public function action(int $spellCardDeckId, $summRolledDice = null)
    {
        // правый враг, 1-4 2 урона,5-9 2 зпмп, 10+ 3 урона , стоять
    }

    public function getKey()
    {
        return 'gigazip';
    }
}
