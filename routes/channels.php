<?php

use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use App\Models\Room;


/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

// Broadcast::channel('chat.{roomId}', function (User $user, int $roomId) {
//     return (int) $user->id === Room::findOrNew($roomId)->user_id;
// });

// Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
//     return (int) $user->id === (int) $id;
// });
 
Broadcast::channel('chat.{roomId}', function ($user,$roomId) {
    if ($user->canJoinRoom($roomId)) {
        return ['id' => $user->id, 'name' => $user->username];
    }
});

//Broadcast::routes(['middleware' => ['auth:sanctum']]);
