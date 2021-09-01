<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Sitemap\SitemapGenerator;
use Illuminate\Support\Facades\Storage;
use Artesaos\SEOTools\Facades\SEOTools;

class MainController extends Controller
{
    //
    public function index()
    {
        SEOTools::setTitle('Create your Free Google Sitemap Online - Google XML Sitemaps Generator');
        SEOTools::setDescription('Free Online Unlimited Google XML Sitemap Generator. Free online sitemap generator service, creating an XML sitemap that can be submitted to Google, Bing and other search engines to help them crawl your website better.');
        SEOTools::opengraph()->setUrl('http://current.url.com');
        SEOTools::setCanonical('https://codecasts.com.br/lesson');
        SEOTools::opengraph()->addProperty('type', 'articles');
        SEOTools::twitter()->setSite('@LuizVinicius73');
        SEOTools::jsonLd()->addImage('https://codecasts.com.br/img/logo.jpg');

        return view('home');
    }

    public function create(Request $request)
    {
        $filename = rand(10, 10000);
        $path = 'sitemaps/sitemap_' . $filename . '.xml';
        $url = $request->url;
        $fullpath = public_path($path);
        SitemapGenerator::create($url)->writeToFile($fullpath);
        $data = array(
            'path' => $path,
        );
        return json_encode($data);
    }

    public function download($url)
    {
        $name = "sitemap.xml";
        return Storage::download($url, $name);
    }
}
