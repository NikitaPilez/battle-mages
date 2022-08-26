<?php

namespace App\Listeners;

use App\Events\SpellPlayed;

class SpellPlayedSubscriber
{
    public function checkInfections($event)
    {
        print_r($event->spellCard->id);
    }

    public function subscribe($events)
    {
        return [
            SpellPlayed::class => 'checkInfections'
        ];
    }
}
