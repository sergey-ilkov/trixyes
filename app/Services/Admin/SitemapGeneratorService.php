<?php

namespace App\Services\Admin;

use App\Helpers\Langs;
use App\Models\Post;
use Exception;
use Illuminate\Support\Carbon;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;

class SitemapGeneratorService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function generate()
    {
        $currentLocale = app()->getLocale();

        $sitemap = Sitemap::create();
        try {
            foreach (Langs::LOCALES as $locale) {

                $segment = '';
                if ($locale != 'uk') {
                    $segment = '/' . $locale;
                }
                // Add URLs to the sitemap
                $sitemap->add(Url::create($segment . '/')->setLastModificationDate(Carbon::yesterday()));
                $sitemap->add(Url::create($segment . '/services')->setLastModificationDate(Carbon::yesterday()));
                $sitemap->add(Url::create($segment . '/blog')->setLastModificationDate(Carbon::yesterday()));
                $sitemap->add(Url::create($segment . '/about')->setLastModificationDate(Carbon::yesterday()));
                $sitemap->add(Url::create($segment . '/contacts')->setLastModificationDate(Carbon::yesterday()));

                app()->setLocale($locale);

                $sitemap->add(Post::where('published', 1)->get());
            }
        } catch (Exception $ex) {

            return 'Error: ' . $ex->getMessage();
        }


        app()->setLocale($currentLocale);
        $sitemap->writeToFile('sitemap.xml');

        return $sitemap;
    }
}