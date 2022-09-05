<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\V1\User\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends BaseController
{
    public function register(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:8|max:32',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error', $validator->errors());
        }

        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password'))
        ]);
        $token = $user->createToken('auth_token')->plainTextToken;

        return $this->sendResponse(['token' => $token], 'User register successfully');
    }

    public function login(Request $request): JsonResponse
    {
        if(!Auth::attempt($request->only('email', 'password'))){
            return $this->sendError('Unauthorised');
        }
        else {
            $user = User::where('email', $request->input('email'))->firstOrFail();
            $token = $user->createToken('auth_token')->plainTextToken;
            return $this->sendResponse(['token' => $token]);
        }
    }
}
