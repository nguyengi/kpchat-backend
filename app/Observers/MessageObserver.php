<?php

namespace App\Observers;

use App\Events\NewMessage;
use App\Models\Message;

class MessageObserver
{
    /**
     * Handle the message "created" event.
     *
     * @param  \App\Models\Message  $message
     * @return void
     */
    public function created(Message $message)
    {
        event(new NewMessage($message));
    }
}
