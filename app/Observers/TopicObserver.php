<?php

namespace App\Observers;

use App\Models\Topic;
use App\Handlers\TranslateHandler;

// creating, created, updating, updated, saving,
// saved,  deleting, deleted, restoring, restored

class TopicObserver
{
    public function creating(Topic $topic)
    {
        //
    }

    public function updating(Topic $topic)
    {
        //
    }

    public function saving(Topic $topic)
    {
        $topic->body = clean($topic->body, 'default');

        $topic->excerpt = make_excerpt($topic->body);

        $topic->slug = app(TranslateHandler::class)->baiduTranslate($topic->title);;
    }
}
