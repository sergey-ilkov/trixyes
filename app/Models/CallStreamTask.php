<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CallStreamTask extends Model
{
    //

    protected $fillable = [
        // 'user_id',
        'task',
        'attributes',
        'result',
        'error',
        'expires_at',
    ];

    protected $casts = [
        'task_id' => 'string',
        'attributes' => 'json',
        'result' => 'boolean',
    ];



    public function user(): BelongsTo
    {
        //
        return $this->belongsTo(User::class);
    }
}