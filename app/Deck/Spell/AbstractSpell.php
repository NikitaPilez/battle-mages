<?php

namespace App\Deck\Spell;

abstract class AbstractSpell
{
    abstract public function action(int $spellCardDeckId);

    abstract public function getKey();
}
