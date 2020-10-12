<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int type
 * @method static Chatroom visibleTo($user)
 */
class Chatroom extends Model
{
    use HasFactory;

    const TYPE_PUBLIC = 1;
    const TYPE_PRIVATE = 2;

    protected $primaryKey = 'chatroom_id';
    protected $fillable = [
        'name',
        'type'
    ];

    public function users()
    {
        return $this->hasManyThrough(
            User::class,
            ChatroomUser::class,
            'chatroom_id',
            'user_id',
            'chatroom_id',
            'user_id'
        );
    }

    public function isPublic()
    {
        return $this->type == self::TYPE_PUBLIC;
    }

    public function isPrivate()
    {
        return $this->type == self::TYPE_PRIVATE;
    }

    public function messages()
    {
        return $this->hasMany(Message::class, 'chatroom_id');
    }

    public function addUser(User $user)
    {
        ChatroomUser::create([
            'chatroom_id' => $this->getKey(),
            'user_id' => $user->getKey()
        ]);
    }

    public function hasUser(User $user) {
        return $this->users()->where('users.user_id', '=', $user->getKey())->exists();
    }

    public function scopeVisibleTo(Builder $builder, User $user) {
        return $builder
            ->where('type', '=', static::TYPE_PUBLIC)
            ->orWhereHas('users', function (Builder $relation) use ($user) {
                $relation->where('users.user_id', '=', $user->getKey());
            });
    }
}
