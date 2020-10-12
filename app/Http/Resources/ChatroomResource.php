<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Chatroom;

class ChatroomResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        /**
         * @var Chatroom $chatroom
         */
        $chatroom = $this->resource;
        return [
            'name' => $chatroom->name,
            'type' => $chatroom->type,
            'id' => $chatroom->chatroom_id,
            'users' => UserResource::collection($chatroom->users)
        ];
    }
}
