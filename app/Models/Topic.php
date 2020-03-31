<?php

namespace App\Models;

class Topic extends Model
{
    protected $fillable = ['title', 'body', 'user_id', 'category_id', 'last_reply_user_id', 'reply_count', 'view_count', 'order', 'excerpt', 'slug'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function replies()
    {
        return $this->hasMany(Reply::class);
    }

    public function scopeOrderWith($query, $order)
    {
        switch ($order) {
            case 'created':
                $query->created();
                break;

            default:
                $query->updated();
                break;
        }
    }

    public function scopeCreated($query)
    {
        return $query->orderBy('created_at', 'desc');
    }

    public function scopeUpdated($query)
    {
        return $query->orderBy('updated_at', 'desc');
    }

    public function link($params = [])
    {
        return route('topics.show', array_merge([$this->id, $this->slug], $params));
    }
}
