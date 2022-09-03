<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        "firstname",
        "lastname",
        "nickname",
        "birthdate",
        "about",
        "avatar",
        "background_photo",
        "website",
        "country",
        "city",
        "state",
        "street",
        "university",
        "degree",
        "study_type",
        "user_id"
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }
    public function commentsLikes()
    {
        return $this->belongsToMany(Comment::class, "comment_like");
    }
    public function postsLikes()
    {
        return $this->belongsToMany(Post::class, "post_like");
    }
    public function phones()
    {
        return $this->hasMany(ProfilePhone::class);
    }
    public function connectionsTo()
    {
        return $this->belongsToMany(Profile::class, "profile_connection", "profile1_id");
    }
    public function connectionsFrom()
    {
        return $this->belongsToMany(Profile::class, "profile_connection", "profile2_id");
    }

    public function followings()
    {
        return $this->belongsToMany(Profile::class, "profile_follow", "profile1_id");
    }
    public function followers()
    {
        return $this->belongsToMany(Profile::class, "profile_follow", "profile2_id");
    }
    public function experiences()
    {
        return $this->hasMany(Experience::class);
    }
    public function certificates()
    {
        return $this->belongsToMany(Certificate::class, "profile_certificate");
    }

    public function managementCompanies()
    {
        return $this->belongsToMany(Company::class, "company_management");
    }

    public function skills()
    {
        return $this->belongsToMany(Skill::class, "profile_skill");
    }
}
