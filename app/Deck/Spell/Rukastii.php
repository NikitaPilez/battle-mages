<?php

namespace App\Deck\Spell;

use App\Models\V1\Deck\SpellCardDeck;

class Rukastii extends AbstractSpell
{

    public function action(SpellCardDeck $spellCard, $summRolledDice = null)
    {
        // TODO: Implement action() method.
    }

    public function getKey()
    {
        return 'rukastii';
    }
}
