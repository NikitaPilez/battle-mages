<?php

namespace App\Mail;

use App\Models\V1\User\UserRoom;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class InviteToRoom extends Mailable
{
    use Queueable, SerializesModels;

    protected UserRoom $userRoom;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(UserRoom $userRoom)
    {
        $this->userRoom = $userRoom;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('test@gmail.com')
            ->subject('Invite to room')
            ->view('emails.invite_to_room')
            ->with([
                'user' => $this->userRoom->user
            ]);
    }
}
