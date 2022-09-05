<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Experience extends Model
{
    use HasFactory;

    protected $fillable = ["start", "end", "position", "company_name", "company_id", "profile_id"];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }
}
