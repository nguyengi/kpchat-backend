<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class UserResource extends JsonResource
{
    private $token = false;

    public function withToken($token)
    {
        $this->token = $token;
        return $this;
    }

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        /**
         * @var User $user
         */
        $user = $this->resource;
        return [
            'id' => $user->getKey(),
            'name' => $user->name,
            'token' => $this->when($this->token, $this->token),
        ];
    }
}
