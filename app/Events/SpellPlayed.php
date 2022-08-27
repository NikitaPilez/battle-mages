<?php

namespace App\Events;

use App\Models\V1\Deck\SpellCardDeck;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class SpellPlayed
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public SpellCardDeck $spellCard;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(SpellCardDeck $spellCard)
    {
        $this->spellCard = $spellCard;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
