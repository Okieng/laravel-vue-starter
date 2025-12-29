<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Feed extends Model
{
    protected $fillable = [
        'user_id',
        'type',
        'content',
        'title',
        'event_date',
        'images',
        'file_attachment',
        'is_pinned',
        'likes_count',
        'comments_count',
    ];

    protected $casts = [
        'event_date' => 'datetime',
        'images' => 'array',
        'file_attachment' => 'array',
        'is_pinned' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function followers()
    {
        return $this->belongsToMany(User::class, 'feed_user');
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
