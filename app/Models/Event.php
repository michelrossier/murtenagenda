<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'date',
        'name',
        'locality',
        'organizer',
        'source_url'
    ];

    protected $casts = [
        'date' => 'date',
    ];
} 