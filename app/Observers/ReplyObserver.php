<?php

namespace App\Observers;

use App\Models\Reply;
use App\Notifications\ReplyNotification;

// creating, created, updating, updated, saving,
// saved,  deleting, deleted, restoring, restored

class ReplyObserver
{
    public function created(Reply $reply)
    {
        $reply->topic->reply_count = $reply->topic->replies->count();
        $reply->topic->save();

        // 进行消息通知
        $reply->topic->user->notify(new ReplyNotification($reply));
        $reply->topic->user->notification_count = $reply->topic->user->unreadNotifications()->count();
        $reply->topic->user->save();
    }

    public function deleted(Reply $reply)
    {
        $reply->topic->reply_count = $reply->topic->replies->count();
        $reply->topic->save();
    }

    public function creating(Reply $reply)
    {
        //
    }

    public function updating(Reply $reply)
    {
        //
    }
}
