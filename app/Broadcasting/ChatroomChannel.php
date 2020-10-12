<?php

namespace App\Broadcasting;

use App\Models\Chatroom;
use App\Models\Message;
use App\Models\User;

class ChatroomChannel
{
    /**
     * Authenticate the user's access to the channel.
     *
     * @param  \App\Models\User  $user
     * @return array|bool
     */
    public function join(User $user, Chatroom $chatroom)
    {
        return $chatroom->isPublic() || $chatroom->hasUser($user);
    }
}
