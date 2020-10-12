<?php

use App\Broadcasting\ChatroomChannel;
use App\Broadcasting\ChatroomsChannel;
use App\Broadcasting\PrivateChatroomChannel;
use Illuminate\Support\Facades\Broadcast;

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

Broadcast::channel('chatrooms.{chatroom}', ChatroomChannel::class, ['guards:api']);

Broadcast::channel('chatrooms', ChatroomsChannel::class, ['guards:api']);
Broadcast::channel('users.{channelUser}.private-chatrooms', PrivateChatroomChannel::class, ['guards:api']);
