<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        "email",
        "email_verified_at"
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }
    public function jobs()
    {
        return $this->hasMany(Job::class);
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
        return $this->hasMany(UserPhone::class);
    }
    public function connectionsTo()
    {
        return $this->belongsToMany(User::class, "user_connection", "user1_id", "user2_id")->withPivot("accepted")->withTimestamps();
    }
    public function connectionsFrom()
    {
        return $this->belongsToMany(User::class, "user_connection", "user2_id", "user1_id")->withPivot("accepted")->withTimestamps();
    }

    public function followings()
    {
        return $this->belongsToMany(User::class, "user_follow", "user1_id", "user2_id")->withTimestamps();
    }
    public function followers()
    {
        return $this->belongsToMany(User::class, "user_follow", "user2_id", "user1_id")->withTimestamps();
    }
    public function experiences()
    {
        return $this->hasMany(Experience::class);
    }
    public function certificates()
    {
        return $this->belongsToMany(Certificate::class, "user_certificate")->withTimestamps();
    }

    public function managementCompanies()
    {
        return $this->belongsToMany(Company::class, "company_management")->withTimestamps();
    }

    public function skills()
    {
        return $this->belongsToMany(Skill::class, "user_skill")->withTimestamps();
    }
}
