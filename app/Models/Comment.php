<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Comment extends Model
{
    use HasFactory;

    protected $fillable = ["content", "photo", "post_id", "user_id", "parent_comment_id", "mention_id"];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function mention()
    {
        return $this->belongsTo(User::class, "mention_id");
    }
    public function replies()
    {
        return $this->hasMany(Comment::class, "parent_comment_id", "id");
    }

    public function parentComment()
    {
        return $this->belongsTo(Comment::class, "parent_comment_id", "id");
    }

    public function reacts()
    {
        return $this->belongsToMany(User::class, "comment_react")->withPivot("type");
    }
}
