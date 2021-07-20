<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Sitemap\SitemapGenerator;
use Illuminate\Support\Facades\Storage;

class MainController extends Controller
{
    //
    public function index()
    {
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
