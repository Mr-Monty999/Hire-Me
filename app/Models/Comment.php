<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Comment extends Model
{
    use HasFactory;

    protected $fillable = ["title", "content", "photo", "post_id", "user_id", "comment_id"];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function replies()
    {
        return $this->hasMany(Comment::class);
    }

    public function parentComment()
    {
        return $this->belongsTo(Comment::class);
    }

    public function reacts()
    {
        return $this->belongsToMany(User::class, "comment_react")->withPivot("type");
    }
}
