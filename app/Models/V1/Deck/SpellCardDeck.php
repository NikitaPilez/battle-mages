<?php

namespace App\Models\V1\Deck;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpellCardDeck extends Model
{
    use HasFactory;

    public $table = 'spell_card_deck';
}
