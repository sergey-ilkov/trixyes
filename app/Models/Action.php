<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Translatable\HasTranslations;

class Action extends Model
{

    use HasTranslations;

    public array $translatable = ['name'];

    protected $fillable = [
        'name',
        'slug',
    ];

    protected $casts = [
        'name' => 'string',
        'slug' => 'string',
    ];



    public function histories(): HasMany
    {
        return $this->hasMany(History::class)->with('service', 'user');
    }
}