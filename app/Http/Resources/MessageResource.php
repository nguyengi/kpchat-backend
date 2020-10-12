<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Message;

class MessageResource extends JsonResource
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
         * @var Message $message
         */
        $message = $this->resource;
        return [
            'id' => $message->message_id,
            'content' => $message->content,
            'user' => UserResource::make($message->user)
        ];
    }
}
