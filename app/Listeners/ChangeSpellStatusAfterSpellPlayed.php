<?php

namespace App\Listeners;

use App\Events\SpellPlayed;
use App\Models\V1\Deck\SpellCardDeck;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ChangeSpellStatusAfterSpellPlayed
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\SpellPlayed  $event
     * @return void
     */
    public function handle(SpellPlayed $event)
    {
        $spellCard = $event->spellCard;
        $spellCard->status = 'played';
        $spellCard->save();
        $remainReadySpells = SpellCardDeck::userSpells($spellCard->user_id, $spellCard->room_id)->where('status', 'ready')->count();
        if ($remainReadySpells === 0) {
            SpellCardDeck::userSpells($spellCard->user_id, $spellCard->room_id)->where('status', 'played')->each(function ($spellCard) {
                $spellCard->status = 'trash';
                $spellCard->save();
            });
        }
    }
}
