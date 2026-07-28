<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = ['name', 'tagline', 'about', 'location', 'email', 'github', 'linkedin'];
}
