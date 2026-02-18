<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CallStreamToken extends Model
{
    //
    protected $fillable = [
        'name',
        'token',
        'expires_at',
    ];

    protected $casts = [
        'name' => 'string',
        'token' => 'string',
    ];
}