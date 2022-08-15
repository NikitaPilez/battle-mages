<?php

namespace App\Http\Controllers\Api\V1\Room;

use App\Http\Controllers\Api\V1\BaseController;
use App\Http\Resources\V1\Room\RoomCollection;
use App\Http\Resources\V1\Room\RoomResource;
use App\Models\V1\Room\Room;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RoomController extends BaseController
{
    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'key' => 'required'
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation error', $validator->errors());
        }

        $query = Room::create($request->all());

        return $this->sendResponse(['id' => $query->id]);
    }

    public function list(Request $request)
    {
        $query = Room::query();

        if ($request->has('search')) {
            $query->where('key', 'like', '%' . $request->input('search') . '%');
        }

        $perPage = 15;
        if ($request->has('rowsPerPage')) {
            $perPage = $request->input('rowsPerPage');
        }

        return response()->json(new RoomCollection($query->paginate($perPage)));
    }

    public function show(int $roomId): RoomResource
    {
        $room = Room::find($roomId);
        return new RoomResource($room);
    }

    public function update(Request $request, int $roomId): JsonResponse
    {
        $room = Room::findOrFail($roomId);
        $room->update($request->all());

        return $this->sendResponse($room);
    }

    public function delete(int $roomId)
    {
        Room::findOrFail($roomId)->delete();
        return $this->sendResponse(message: 'success');
    }
}
