<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = ["title", "content", "photo", "post_id", "profile_id", "comment_id"];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }

    public function replies()
    {
        return $this->hasMany(Comment::class);
    }

    public function parentComment()
    {
        return $this->belongsTo(Comment::class);
    }

    public function likes()
    {
        return $this->belongsToMany(Profile::class, "comment_like");
    }
}
