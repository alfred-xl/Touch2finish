<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;

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

        $urls = [];

        // Homepage
        $urls[] = [
            'loc'        => url('/'),
            'lastmod'    => now()->toDateString(),
            'changefreq' => 'weekly',
            'priority'   => '1.0',
        ];

        // Service pages
        foreach ($serviceSlugs as $slug) {
            $urls[] = [
                'loc'        => route('service.show', $slug),
                'lastmod'    => now()->toDateString(),
                'changefreq' => 'monthly',
                'priority'   => '0.8',
            ];
        }

        $xml = view('sitemap', compact('urls'))->render();

        return response($xml, 200, [
            'Content-Type'  => 'application/xml; charset=utf-8',
            'Cache-Control' => 'public, max-age=86400', // Cache for 24 hours
        ]);
    }
}
