<?php

namespace App\Deck\Spell;

class DosugSAsfiksiei extends AbstractSpell
{
    public function action(int $spellCardDeckId, $summRolledDice = null)
    {
        // жертва враг с сокровищем, замок: жертвами становятся все враги, 1-4 захвати замок, 5-9 2урона, 10+ 2 урона 1 зпмп
    }

    public function getKey()
    {
        return 'dosug-s-asfiksiei';
    }
}
