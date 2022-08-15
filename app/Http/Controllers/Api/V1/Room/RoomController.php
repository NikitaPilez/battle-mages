<?php

namespace App\Http\Controllers\Api\V1\Room;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\Room\RoomCollection;
use App\Http\Resources\V1\Room\RoomResource;
use App\Models\V1\Room\Room;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        $query = Room::create($request->all());

        return response()->json([
            'status' => 'success',
            'record' => $query->id,
        ]);
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

        return response()->json([
            'status' => 'success',
            'message' => 'Record updated',
        ]);
    }

    public function delete(int $roomId)
    {
        Room::find($roomId)->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Record deleted',
        ]);
    }
}
