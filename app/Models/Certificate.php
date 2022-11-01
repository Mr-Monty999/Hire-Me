<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Certificate extends Model
{
    use HasFactory;

    protected $fillable = ["name", "company_name", "company_id"];


    public function users()
    {
        return $this->belongsToMany(User::class, "user_certificate");
    }
    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
