<?php

namespace App\Events;

use App\Models\Chatroom;
use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ChatroomInviteEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @var Chatroom $chatroom
     */
    private $chatroom;
    
    /**
     * @var User $user
     */
    private $user;

    public function __construct(Chatroom $chatroom, User $user)
    {
        $this->chatroom = $chatroom;
        $this->user = $user;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel("users.{$this->user->user_id}.private-chatrooms");
    }

    public function broadcastAs()
    {
        return 'chatroom_invite';
    }

    public function broadcastWith()
    {
        return [
            'id' => $this->chatroom->getKey(),
            'name' => $this->chatroom->name,
            'type' => $this->chatroom->type,
            'users' => $this->chatroom->users->map(function (User $participant) {
                return [
                    'id' => $participant->getKey(),
                    'name' => $participant->name,
                ];
            })
        ];
    }
}
