<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property User user
 *
 */
class Message extends Model
{
    use HasFactory;

    protected $primaryKey = 'message_id';
    protected $guarded = [];

    public function chatroom()
    {
        return $this->belongsTo(Chatroom::class, 'chatroom_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id')->withTrashed();
    }
}
