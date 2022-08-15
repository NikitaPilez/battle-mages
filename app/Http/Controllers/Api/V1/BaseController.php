<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;

class BaseController extends Controller
{
    public function sendResponse($result = [], $message = []): JsonResponse
    {
        $response = [
            'data' => $result,
        ];

        if(!empty($message)){
            $response['message'] = $message;
        }
        return response()->json($response);
    }

    public function sendError($error, $errorMessages = [], $code = 404): JsonResponse
    {
        $response = [
            'error' => $error,
        ];

        if(!empty($errorMessages)){
            $response['data'] = $errorMessages;
        }

        return response()->json($response, $code);
    }
}
