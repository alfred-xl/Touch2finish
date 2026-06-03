<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Support\Facades\URL;

class SitemapController extends Controller
{
    public function index(): Response
    {
        // All service slugs — keep in sync with ContactController::getServicesData()
        $serviceSlugs = [
            'removals-handyman',
            'car-valeting',
            'interior-decor',
            'real-estate',
            'cleaning',
        ];


        $baseUrl = rtrim(config('app.url'), '/');

        $urls = [];

        // Homepage
        $urls[] = [
            'loc'        => $baseUrl . '/',
            'lastmod'    => now()->toDateString(),
            'changefreq' => 'weekly',
            'priority'   => '1.0',
        ];

        // Service pages
        foreach ($serviceSlugs as $slug) {
            $urls[] = [
                'loc'        => $baseUrl . '/services/' . $slug,
                'lastmod'    => now()->toDateString(),
                'changefreq' => 'monthly',
                'priority'   => '0.8',
            ];
        }

        $xml = view('sitemap', compact('urls'))->render();

        return response($xml, 200, [
            // Google requires this exact content-type for XML sitemaps.
            'Content-Type'  => 'application/xml; charset=UTF-8',
            'Cache-Control' => 'no-cache, no-store, must-revalidate',
            'Pragma'        => 'no-cache',
            'Expires'       => '0',
        ]);
    }
}
