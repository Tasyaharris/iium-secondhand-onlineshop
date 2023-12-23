<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;

use App\Models\Room;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\StoreRoomRequest;
use App\Http\Requests\UpdateRoomRequest;

use function RingCentral\Psr7\copy_to_stream;
use function RingCentral\Psr7\copy_to_string;

//use GuzzleHttp\Psr7\Request;

class RoomController extends Controller
{
    public function create(Request $request)
{
    try {
        $me = auth()->user()->id;
        $friend = $request->friend_id;

        // Check if the room already exists
        $room = Room::where("users", $me.":".$friend)
                    ->orWhere("users", $friend.":".$me)
                    ->first();

        //dd($room);

        if (!$room) {
            // Room does not exist, create a new one
            $room = Room::create([
                'users' => $me . ':' . $friend,
            ]);
        }

        return response()->json([
            'success' => true,
            'data' => $room,
        ]);
    } catch (\Exception $e) {
        // Log the error
        Log::error('Room creation error: ' . $e->getMessage());

        // Return an error response
        return response()->json([
            'success' => false,
            'error' => $e,
        ], 500);
    }
}

  
}