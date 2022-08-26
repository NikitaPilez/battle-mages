<?php

namespace App\Listeners;

use App\Events\SpellPlayed;

class MakeDamageAfterSpellPlayed
{
    public function handle(SpellPlayed $event)
    {
        print_r('sdf');
    }
}
