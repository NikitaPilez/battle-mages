<?php

namespace App\Http\Controllers\Api\V1\Infection;

use App\Http\Controllers\Api\V1\BaseController;
use App\Http\Requests\V1\Infection\GetPlayerCardsRequest;
use App\Http\Requests\V1\Infection\GiveInfectionRequest;
use App\Http\Requests\V1\Infection\NewDeckRequest;
use App\Http\Requests\V1\Infection\RevokeInfectionRequest;
use App\Models\V1\User\UserRoom;
use App\Services\V1\Infection\InfectionService;
use Illuminate\Http\JsonResponse;

class InfectionController extends BaseController
{
    public InfectionService $infectionService;

    public function __construct(InfectionService $infectionService)
    {
        $this->infectionService = $infectionService;
    }

    public function new(NewDeckRequest $request): JsonResponse
    {
        return $this->sendResponse($this->infectionService->newDeck($request->input('roomId')));
    }

    public function give(GiveInfectionRequest $request): JsonResponse
    {
        $userRoom = UserRoom::where('room_id', $request->input('roomId'))->where('user_id', $request->input('userId'))->first();
        $infectionCard = $this->infectionService->give($userRoom, $request->input('infectionCardDeckId'));
        return $this->sendResponse($infectionCard);
    }

    public function revoke(RevokeInfectionRequest $request): JsonResponse
    {
        $this->infectionService->revoke($request->input('infectionCardDeckId'));
        return $this->sendResponse(message: 'success');
    }

    public function getUserInfections(GetPlayerCardsRequest $request): JsonResponse
    {
        return response()->json($this->infectionService->getPlayerInfections($request->input('userId'), $request->input('roomId'), $request->input('status')));
    }
}
