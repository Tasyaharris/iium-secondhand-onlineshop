<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\User;

use App\Http\Requests\StoreRoomRequest;
use App\Http\Requests\UpdateRoomRequest;
use GuzzleHttp\Psr7\Request;

class RoomController extends Controller
{
  public function create(Request $request)
  {
    $me = auth()->user->id;
    $friend = $request->friend_id;

    $room = Room::where('users', $me.":".$friend)
            ->orWhere('users', $friend.":".$me)
            ->first();

    if($room){
        $dataRoom = $room;
    }else{
        $dataRoom = Room::create([
            'users'=> $me.":".$friend
        ]);
    }

    return response()->json([
        'success' =>true,
        'data' => $dataRoom
    ]);

  }
}
