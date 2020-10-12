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

class UserJoin implements ShouldBroadcast
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

    /**
     * Create a new event instance.
     *
     * @return void
     */
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
        return new PrivateChannel("chatrooms.{$this->chatroom->chatroom_id}");
    }

    public function broadcastAs()
    {
        return 'user_join';
    }

    public function broadcastWith()
    {
        return [
            'id' => $this->user->getKey(),
            'name' => $this->user->name,
        ];
    }
}
