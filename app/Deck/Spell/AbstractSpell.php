<?php

namespace App\Deck\Spell;

use App\Models\V1\Deck\SpellCardDeck;

abstract class AbstractSpell
{
    abstract public function action(SpellCardDeck $spellCard, $summRolledDice = null);

    abstract public function getKey();
}
