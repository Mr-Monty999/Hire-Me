<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    protected $fillable = ["title", "description", "location", "user_id"];

    protected $with = ["user:id,firstname,lastname,avatar"];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
