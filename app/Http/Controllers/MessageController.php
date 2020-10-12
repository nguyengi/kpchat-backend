<?php

namespace App\Http\Controllers;

use App\Events\UserJoin;
use App\Http\Resources\MessageResource;
use App\Models\Chatroom;
use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index(Chatroom $chatroom, Request $request)
    {
        $messages = $chatroom->messages()->with('user')->orderBy('created_at')->get();
        return MessageResource::collection($messages);
    }

    public function store(Chatroom $chatroom, Request $request)
    {
        if (! $chatroom->hasUser($request->user())) {
            $chatroom->addUser($request->user());
        }
        event(new UserJoin($chatroom, $request->user()));
        $message = Message::create([
            'user_id' => $request->user()->user_id,
            'chatroom_id' => $chatroom->chatroom_id,
            'content' => $request->get('content')
        ]);
        return MessageResource::make($message);
    }
}
