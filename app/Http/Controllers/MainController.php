<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Sitemap\SitemapGenerator;
use Illuminate\Support\Facades\Storage;
use Artesaos\SEOTools\Facades\SEOTools;
use App\Models\Websitescrawl;

class MainController extends Controller
{
    //
    public function index()
    {
        $url  = \URL::current();
        $ogImage = asset('images/og-image.jpg');
        SEOTools::setTitle('Free Online Unlimited Google XML Sitemap Generator');
        SEOTools::setDescription('Free Online Unlimited Google XML Sitemap Generator. Free online sitemap generator service, creating an XML sitemap that can be submitted to Google, Bing and other search engines to help them crawl your website better.');
        SEOTools::opengraph()->setUrl($url);
        SEOTools::addImages($ogImage);
        SEOTools::setCanonical($url);
        SEOTools::opengraph()->addProperty('type', 'articles');
        SEOTools::jsonLd()->addImage($ogImage);

        return view('home');
    }

    public function create(Request $request)
    {
        $request->validate([
            'url'          => 'required|url',
            'g-recaptcha-response' => 'required|captcha',
        ]);
        $filename = time();
        $path = 'sitemaps/sitemap_' . $filename . '.xml';
        $url = $request->url;
        $fullpath = public_path($path);
        SitemapGenerator::create($url)->writeToFile($fullpath);
        $data = array(
            'path' => $path,
        );

        // save crawled website
        $Websitescrawl = new Websitescrawl();
        $Websitescrawl->ip = agent()->ip;
        $Websitescrawl->browser = agent()->browser->name;
        $Websitescrawl->device = agent()->device->type;
        $Websitescrawl->platform = agent()->os->name;
        $Websitescrawl->isBot = agent()->isBot;
        $Websitescrawl->bot = agent()->bot;
        $Websitescrawl->website = $url;
        $Websitescrawl->sitemap = $path;
        $Websitescrawl->save();

        return json_encode($data);
    }

    public function download($url)
    {
        $name = "sitemap.xml";
        return Storage::download($url, $name);
    }
}
