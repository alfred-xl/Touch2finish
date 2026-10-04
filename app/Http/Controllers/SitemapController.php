<?php

namespace App\Http\Controllers;

use App\Support\Seo;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    public function index(): Response
    {
        $urls = [
            [
                'loc' => Seo::route('home'),
                'changefreq' => 'weekly',
                'priority' => '1.0',
            ],
            [
                'loc' => Seo::route('services.index'),
                'changefreq' => 'monthly',
                'priority' => '0.9',
            ],
        ];

        foreach (config('touch2finish.services', []) as $service) {
            $urls[] = [
                'loc' => Seo::route('services.show', ['slug' => $service['slug']]),
                'changefreq' => 'monthly',
                'priority' => '0.8',
            ];
        }

        foreach ([['about', '0.7'], ['areas', '0.7'], ['legal.privacy', '0.3'], ['legal.cookies', '0.3'], ['legal.terms', '0.3']] as [$route, $priority]) {
            $urls[] = ['loc' => Seo::route($route), 'changefreq' => 'yearly', 'priority' => $priority];
        }

        return response(view('sitemap', compact('urls'))->render(), 200, [
            'Content-Type' => 'application/xml; charset=UTF-8',
            'Cache-Control' => 'public, max-age=3600',
        ]);
    }
}
