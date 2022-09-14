<?php

namespace App\Http\Controllers\Api\V1;

use App\Actions\User\LoginUserAction;
use App\Actions\User\RegisterUserAction;
use App\Actions\User\VerifyEmailAction;
use App\Http\Requests\V1\User\LoginUserRequest;
use App\Http\Requests\V1\User\RegisterUserRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends BaseController
{
    public function register(RegisterUserRequest $request, RegisterUserAction $registerUserAction): JsonResponse
    {
        $result = $registerUserAction->execute($request->validated());
        return $this->sendResponse($result, 'User register successfully');
    }

    public function login(LoginUserRequest $request, LoginUserAction $loginUserAction): JsonResponse
    {
        $result = $loginUserAction->execute($request->validated());
        return $result['success'] ? $this->sendResponse($result) : $this->sendError($result);
    }

    public function verify(Request $request, VerifyEmailAction $verifyEmailAction): JsonResponse
    {
        $message = $verifyEmailAction->execute($request->id);
        return $this->sendResponse(message: $message);
    }
}
