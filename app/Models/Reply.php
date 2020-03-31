<?php

namespace App\Models;

class Reply extends Model
{
    protected $fillable = ['user_id', 'topic_id', 'content'];

    public function topic()
    {
        return $this->belongsTo(Topic::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
