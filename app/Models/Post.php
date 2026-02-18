<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Spatie\Sitemap\Contracts\Sitemapable;
use Spatie\Sitemap\Tags\Url;
use Spatie\Translatable\HasTranslations;

class Post extends Model implements Sitemapable
{
    use HasTranslations;

    public array $translatable = ['title', 'slug', 'description', 'body'];

    protected $fillable = [
        'title',
        'slug',
        'description',
        'views',
        'image',
        'image_min',
        'alt_image',
        'body',
        'published',
        'slider',
    ];

    protected $casts = [
        'title' => 'string',
        'slug' => 'string',
        'description' => 'string',
        'views' => 'integer',
        'image' => 'string',
        'image_min' => 'string',
        'alt_image' => 'string',
        'body' => 'string',
        'published' => 'boolean',
        'slider' => 'boolean',
    ];

    public function toSitemapTag(): Url | string | array
    {
        // Simple return:
        // return route('blog.post.show', $this);

        // Return with fine-grained control:
        return Url::create(route('article', $this->slug))
            ->setLastModificationDate(Carbon::create($this->updated_at));
    }
}