<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Profile;

class Certificate extends Model
{
    use HasFactory;

    protected $fillable = ["name", "company_name", "company_id"];


    // public function be
    // {
    // }
}
