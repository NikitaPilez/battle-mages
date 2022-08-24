<?php

namespace App\Deck\Spell;

abstract class AbstractSpell
{
    abstract public function action(int $spellCardDeckId, $summRolledDice = null);

    abstract public function getKey();
}
