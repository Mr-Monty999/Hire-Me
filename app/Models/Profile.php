<?php

namespace App\Models;

use DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Notification;

class Profile extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        "firstname",
        "lastname",
        "nickname",
        "gender",
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
    public function commentsReacts()
    {
        return $this->belongsToMany(Comment::class, "comment_react")->withTimestamps();
    }
    public function postsReacts()
    {
        return $this->belongsToMany(Post::class, "post_react")->withPivot("type")->withTimestamps();
    }
    public function phones()
    {
        return $this->hasMany(ProfilePhone::class);
    }
    public function connectionsTo()
    {
        return $this->belongsToMany(Profile::class, "profile_connection", "profile1_id", "profile2_id")->withPivot("accepted")->withTimestamps();
    }
    public function connectionsFrom()
    {
        return $this->belongsToMany(Profile::class, "profile_connection", "profile2_id", "profile1_id")->withPivot("accepted")->withTimestamps();
    }

    public function followings()
    {
        return $this->belongsToMany(Profile::class, "profile_follow", "profile1_id", "profile2_id")->withTimestamps();
    }
    public function followers()
    {
        return $this->belongsToMany(Profile::class, "profile_follow", "profile2_id", "profile1_id")->withTimestamps();
    }
    public function experiences()
    {
        return $this->hasMany(Experience::class);
    }
    public function certificates()
    {
        return $this->belongsToMany(Certificate::class, "profile_certificate")->withTimestamps();
    }

    public function managementCompanies()
    {
        return $this->belongsToMany(Company::class, "company_management")->withTimestamps();
    }

    public function skills()
    {
        return $this->belongsToMany(Skill::class, "profile_skill")->withTimestamps();
    }
}
