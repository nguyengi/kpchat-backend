<?php

namespace App\Events;

use App\Models\Chatroom;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NewChatroom implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @var Chatroom $chatroom
     */
    private $chatroom;
    
    public function __construct(Chatroom $chatroom)
    {
        $this->chatroom = $chatroom;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        if ($this->chatroom->isPrivate()) {
            return [];
        }
        return new PrivateChannel("chatrooms");
    }

    public function broadcastAs()
    {
        return 'new_chatroom';
    }

    public function broadcastWith()
    {
        return [
            'id' => $this->chatroom->getKey(),
            'name' => $this->chatroom->name,
            'type' => $this->chatroom->type,
            'users' => []
        ];
    }
}
