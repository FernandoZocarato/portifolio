<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    protected $fillable = ['role', 'company', 'start_date', 'end_date', 'description', 'sort_order'];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
    ];
}
