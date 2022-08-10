<?php

namespace App\Http\Controllers\Api\V1\Deck;

use App\Http\Controllers\Controller;
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

    public function delete(string $key)
    {
        Room::where('key', $key)->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Record deleted',
        ]);
    }
}
