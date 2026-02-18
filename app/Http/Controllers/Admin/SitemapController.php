<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Admin\SitemapGeneratorService;
use Illuminate\Http\Request;

class SitemapController extends Controller
{
    public $sitemapService;
    //
    public function __construct(SitemapGeneratorService $sitemapService)
    {
        $this->sitemapService = $sitemapService;
    }
    public function index()
    {
        // 
        return view('admin.sitemap.index');
    }

    public function createSitemap()
    {


        return $this->sitemapService->generate();
    }
}
