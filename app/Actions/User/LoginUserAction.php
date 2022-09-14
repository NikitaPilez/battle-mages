<?php

namespace App\Actions\User;

use App\Models\V1\User\User;
use Illuminate\Support\Facades\Auth;

class LoginUserAction
{
    public function execute(array $data)
    {
        if(!Auth::attempt($data)) {
            return [
                'success' => false,
                'error' => 'Unauthorised'
            ];
        }
        else {
            $user = User::where('email', $data['email'])->firstOrFail();
            $token = $user->createToken('auth_token')->plainTextToken;
            return [
                'success' => true,
                'token' => $token
            ];
        }
    }
}
