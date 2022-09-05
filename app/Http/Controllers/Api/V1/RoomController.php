<?php

namespace App\Http\Controllers\Api\V1;

use App\Actions\Room\InviteToRoomAction;
use App\Http\Requests\V1\Room\CreateRoomRequest;
use App\Http\Requests\V1\Room\InviteToRoomRequest;
use App\Http\Requests\V1\Room\UpdateRoomRequest;
use App\Http\Resources\V1\Room\RoomCollection;
use App\Http\Resources\V1\Room\RoomResource;
use App\Models\V1\Room\Room;
use Illuminate\Http\JsonResponse;

class RoomController extends BaseController
{
    public function store(CreateRoomRequest $request): JsonResponse
    {
        $room = Room::create($request->validated());
        return $this->sendResponse(new RoomResource($room));
    }

    public function list()
    {
        return response()->json(new RoomCollection(Room::all()));
    }

    public function show(Room $room): RoomResource
    {
        return new RoomResource($room);
    }

    public function update(UpdateRoomRequest $request, Room $room): RoomResource
    {
        $room->update($request->validated());
        return new RoomResource($room);
    }

    public function delete(Room $room): JsonResponse
    {
        $room->delete();
        return $this->sendResponse(message: 'success');
    }

    public function invite(InviteToRoomRequest $request, InviteToRoomAction $action): JsonResponse
    {
        $action->execute($request->input('roomId'), $request->input('usersIds'));
        return $this->sendResponse(message: 'success');
    }
}
