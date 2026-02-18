<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\Translatable\HasTranslations;

class ServiceCategory extends Model
{
    use HasTranslations;

    public array $translatable = ['name', 'title', 'description'];

    protected $fillable = [
        'name',
        'title',
        'description',
        'slug',
    ];

    protected $casts = [
        'name' => 'string',
        'title' => 'string',
        'description' => 'string',
        'slug' => 'string',
    ];



    public function services(): BelongsToMany
    {

        // return $this->belongsToMany(Service::class);
        // return $this->belongsToMany(Service::class)->withPivot('rating');
        // return $this->belongsToMany(Service::class)->withPivot('rating')->orderBy('pivot_rating', 'desc');
        return $this->belongsToMany(Service::class)->withPivot('rating')->orderByPivot('rating', 'desc');
    }
}
