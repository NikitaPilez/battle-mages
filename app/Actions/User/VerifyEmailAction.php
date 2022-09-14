<?php

namespace App\Actions\User;

use App\Models\V1\User\User;
use Illuminate\Auth\Events\Verified;

class VerifyEmailAction
{
    public function execute($userId): string
    {
        /** @var User $user */
        $user = User::findOrFail($userId);

        if ($user->hasVerifiedEmail()) {
            return 'Already verified';
        }

        if ($user->markEmailAsVerified()) {
            event(new Verified($user));
        }

        return 'Success verified';
    }
}
