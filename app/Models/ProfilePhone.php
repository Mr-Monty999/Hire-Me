<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class ProfilePhone extends Model
{
    use HasFactory;

    protected $fillable = ["phone", "profile_id"];

    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }
}
