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
}
