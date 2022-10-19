<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    protected $fillable = ["title", "description", "location", "profile_id"];

    protected $with = ["profile:id,firstname,lastname,avatar"];

    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }
}
