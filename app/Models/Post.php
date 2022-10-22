<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Post extends Model
{
    use HasFactory;
    protected $fillable = ["title", "content", "photo", "user_id"];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    public function reacts()
    {
        return $this->belongsToMany(User::class, "post_react")->withPivot("type")->withTimestamps();
    }
    public function likes()
    {
        return $this->reacts()->wherePivot("type", "=", 1);
    }
    public function disLikes()
    {
        return $this->reacts()->wherePivot("type", "=", 2);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, "post_tag")->withTimestamps();
    }
}
