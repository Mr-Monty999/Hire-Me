<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $fillable = ["name", "email", "country", "city", "state", "street", "logo", "website"];



    public function phones()
    {

        return $this->hasMany(CompanyPhone::class);
    }

    public function experiences()
    {
        return $this->hasMany(Experience::class);
    }

    public function certificates()
    {

        return $this->hasMany(Certificate::class);
    }

    public function managementProfiles()
    {
        return $this->belongsToMany(Profile::class, "company_management");
    }

    public function followers()
    {
        return $this->belongsToMany(Profile::class, "company_follow");
    }
}
