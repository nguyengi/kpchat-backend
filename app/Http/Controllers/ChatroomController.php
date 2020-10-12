<?php

namespace App\Http\Controllers;

use App\Events\ChatroomInviteEvent;
use App\Events\UserJoin;
use App\Http\Requests\CreateChatroomRequest;
use App\Http\Requests\InviteUserRequest;
use App\Http\Resources\ChatroomResource;
use App\Models\Chatroom;
use App\Models\User;
use Illuminate\Http\Request;

class ChatroomController extends Controller
{
    public function index(Request $request)
    {
        $chatrooms = Chatroom::visibleTo($request->user())->get();
        return ChatroomResource::collection($chatrooms);
    }

    public function store(CreateChatroomRequest $request)
    {
        /**
         * @var Chatroom $chatroom
         */
       $chatroom = Chatroom::create($request->validated());
       $chatroom->addUser($request->user());
       
       return ChatroomResource::make($chatroom);
    }

    public function invite(InviteUserRequest $request, Chatroom $chatroom)
    {
        $user = User::findByName($request->get('name'));
        $chatroom->addUser($user);
        event(new ChatroomInviteEvent($chatroom, $user));
        event(new UserJoin($chatroom, $user));
        return ChatroomResource::make($chatroom);
    }
}
