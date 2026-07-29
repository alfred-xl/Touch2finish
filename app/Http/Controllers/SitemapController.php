<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;

class SitemapController extends Controller
{
    public function index(): Response
    {
        $today = now()->toDateString();
        $urls = [
            [
                'loc' => route('home'),
                'lastmod' => $today,
                'changefreq' => 'weekly',
                'priority' => '1.0',
            ],
            [
                'loc' => route('services.index'),
                'lastmod' => $today,
                'changefreq' => 'monthly',
                'priority' => '0.9',
            ],
        ];

        foreach (config('touch2finish.services', []) as $service) {
            $urls[] = [
                'loc' => route('services.show', ['slug' => $service['slug']]),
                'lastmod' => $today,
                'changefreq' => 'monthly',
                'priority' => '0.8',
            ];
        }

        foreach ([['areas', '0.7'], ['legal.privacy', '0.3'], ['legal.cookies', '0.3'], ['legal.terms', '0.3']] as [$route, $priority]) {
            $urls[] = ['loc' => route($route), 'lastmod' => $today, 'changefreq' => 'yearly', 'priority' => $priority];
        }

        return response(view('sitemap', compact('urls'))->render(), 200, [
            'Content-Type' => 'application/xml; charset=UTF-8',
            'Cache-Control' => 'public, max-age=3600',
        ]);
    }
}
