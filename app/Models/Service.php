<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Translatable\HasTranslations;

class Service extends Model
{
    use HasTranslations;

    public array $translatable = ['name', 'license', 'comp_name', 'address'];

    protected $fillable = [
        'name',
        'icon',
        'alt_image',
        'interset',
        'term',
        'amount',
        'promo_code',
        'promo_discount',
        'vote_rating',
        'vote_count',
        'url',
        'license',
        'comp_name',
        'email',
        'address',
        'phone',
        'published',

    ];

    protected $casts = [
        'name' => 'string',
        'icon' => 'string',
        'alt_image' => 'string',
        'interset' => 'double',
        'term' => 'integer',
        'amount' => 'integer',
        'promo_code' => 'string',
        'promo_discount' => 'integer',
        'vote_rating' => 'integer',
        'vote_count' => 'integer',
        'url' => 'string',
        'license' => 'string',
        'comp_name' => 'string',
        'email' => 'string',
        'address' => 'string',
        'phone' => 'string',
        'published' => 'boolean',
    ];


    public function serviceCategories(): BelongsToMany
    {

        return $this->belongsToMany(ServiceCategory::class)->withPivot('rating');
    }




    public function histories(): HasMany
    {
        return $this->hasMany(History::class)->with('user', 'action');
    }

    public function userHistories(): HasMany
    {

        return $this->hasMany(History::class)->with('action');
    }
}