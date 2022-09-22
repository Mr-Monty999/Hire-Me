<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Post extends Model
{
    use HasFactory;
    protected $fillable = ["title", "content", "photo", "profile_id"];

    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    public function reacts()
    {
        return $this->belongsToMany(Profile::class, "post_react")->withPivot("type");
    }
    public function tags()
    {
        return $this->belongsToMany(Tag::class, "post_tag");
    }
}
