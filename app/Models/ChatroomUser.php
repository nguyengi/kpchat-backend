<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatroomUser extends Model
{
    use HasFactory;

    protected $primaryKey = 'chatroom_user_id';
    protected $guarded = [];
    protected $table = 'chatroom_user';
}
