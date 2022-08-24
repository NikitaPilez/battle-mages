<?php

namespace App\Http\Controllers\Api\V1\Room;

use App\Http\Controllers\Api\V1\BaseController;
use App\Http\Requests\V1\Room\CreateRoomRequest;
use App\Http\Requests\V1\Room\InviteToRoomRequest;
use App\Http\Resources\V1\Room\RoomCollection;
use App\Http\Resources\V1\Room\RoomResource;
use App\Models\V1\Room\Room;
use App\Services\V1\Room\RoomService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoomController extends BaseController
{
    public function store(CreateRoomRequest $request): JsonResponse
    {
        $adminId = $request->has('adminId') ? $request->input('adminId') : Auth::user()->id;
        return $this->sendResponse(Room::create([
            'admin_id' => $adminId,
            'key' => $request->input('key')
        ]));
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
        return new RoomResource(Room::findOrFail($roomId));
    }

    public function update(Request $request, int $roomId): RoomResource
    {
        $room = Room::findOrFail($roomId);
        $room->update($request->all());

        return new RoomResource($room);
    }

    public function delete(int $roomId)
    {
        Room::findOrFail($roomId)->delete();
        return $this->sendResponse(message: 'success');
    }

    public function invite(InviteToRoomRequest $request, RoomService $roomService)
    {
        $roomService->inviteToRoom($request->input('roomId'), $request->input('usersIds'));
        return $this->sendResponse(message: 'success');
    }
}
