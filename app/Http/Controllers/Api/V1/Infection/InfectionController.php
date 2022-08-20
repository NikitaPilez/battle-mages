<?php

namespace App\Http\Controllers\Api\V1\Infection;

use App\Http\Controllers\Api\V1\BaseController;
use App\Http\Requests\V1\Infection\NewDeckRequest;
use App\Services\V1\Infection\InfectionService;

class InfectionController extends BaseController
{
    public function new(NewDeckRequest $request, InfectionService $infectionService)
    {
        return $this->sendResponse($infectionService->newDeck($request->input('roomId')));
    }
}
