<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'title', 'summary', 'technologies', 'demo_url', 'code_url',
        'image_url', 'is_demo', 'sort_order',
    ];

    protected function casts(): array
    {
        return ['technologies' => 'array', 'is_demo' => 'boolean'];
    }
}
