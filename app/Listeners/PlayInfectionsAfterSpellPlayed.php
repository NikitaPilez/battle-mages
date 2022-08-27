<?php

namespace App\Listeners;

use App\Events\SpellPlayed;
use App\Models\V1\Deck\SpellCardDeck;
use App\Models\V1\Infection\InfectionCardDeck;
use App\Models\V1\User\UserRoom;
use App\Services\V1\Deck\GameMovesServices;
use App\Services\V1\Infection\InfectionService;

class PlayInfectionsAfterSpellPlayed
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
        $infectionService = new InfectionService();
        $spellCard = $event->spellCard;
        $remainReadySpells = SpellCardDeck::where('room_id', $spellCard->room_id)->where('user_id', $spellCard->user_id)->where('status', 'ready')->count();
        if ($remainReadySpells === 0) {
            $userRoom = UserRoom::where('room_id', $spellCard->room_id)->where('user_id', $spellCard->user_id)->first();
            $myInfections = $infectionService->getPlayerInfections($userRoom);
        /** @var InfectionCardDeck $myInfections */
        foreach ($myInfections as $infection) {
                $comment = 'Получил за ЗПМП ' . $infection->infection->key;
                if ($infection->infection->key === 'tonkovich') {
                    GameMovesServices::makeDamage(-2, $userRoom, $comment);
                } elseif ($infection->infection->key === 'lihach') {
                    GameMovesServices::makeDamage($myInfections->count() * -1, $userRoom, $comment);
                } elseif ($infection->infection->key === 'horoshko') {
                    GameMovesServices::makeDamage(-1, $userRoom, $comment);
                }
            }
        }
    }
}
