<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    //
    protected $fillable = [
        'name',
        'surname',
        'rating',
        'text',
    ];

    protected $casts = [
        'name' => 'string',
        'surname' => 'string',
        'rating' => 'integer',
        'text' => 'string',
    ];
}