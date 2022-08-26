<?php

namespace App\Listeners;

use App\Events\SpellPlayed;
use App\Models\V1\Deck\SpellCardDeck;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ChangeStatusAfterSpellPlayed
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
        $remainReadySpells = SpellCardDeck::where('room_id', $spellCard->room_id)->where('user_id', $spellCard->user_id)->where('status', 'ready')->count();
        if ($remainReadySpells === 0) {
            print_r('Yes');
        } else {
            print_r('No');
        }
    }
}
