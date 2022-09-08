<?php

namespace App\Jobs;

use App\Mail\InviteToRoom;
use App\Models\V1\User\UserRoom;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class WelcomeMailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private UserRoom $userRoom;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(UserRoom $userRoom)
    {
        $this->userRoom = $userRoom;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to($this->userRoom->user)->send(new InviteToRoom($this->userRoom));
    }
}
