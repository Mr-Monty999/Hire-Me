<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Certificate extends Model
{
    use HasFactory;

    protected $fillable = ["name", "company_name", "company_id"];


    public function profiles()
    {
        return $this->belongsToMany(Profile::class, "profile_certificate");
    }
    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
