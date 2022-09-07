<?php

namespace App\Jobs;

use App\Models\V1\User\UserRoom;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

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
//        $this->userRoom->health_points = 30;
//        $this->userRoom->save();
    }
}
