<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes, HasApiTokens;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
    ];

    protected $primaryKey = 'user_id';

    public static function findByName($name)
    {
        return static::query()->where('name', '=', $name)->first();
    }

    public function chatrooms()
    {
        return $this->hasManyThrough(
            Chatroom::class,
            ChatroomUser::class,
            'user_id',
            'chatroom_id',
            'user_id',
            'chatroom_id',
        );
    }
}
