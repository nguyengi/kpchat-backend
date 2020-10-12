<?php

namespace App\Observers;

use App\Events\NewChatroom;
use App\Models\Chatroom;

class ChatroomObserver
{
    /**
     * Handle the chatroom "created" event.
     *
     * @param  \App\Models\Chatroom  $chatroom
     * @return void
     */
    public function created(Chatroom $chatroom)
    {
        event(new NewChatroom($chatroom));
    }
}
