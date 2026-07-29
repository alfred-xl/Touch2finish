<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class ServiceController extends Controller
{
    public function index(): View
    {
        return view('services.index', [
            'services' => config('touch2finish.services', []),
            'business' => config('touch2finish.business', []),
        ]);
    }

    public function show(string $slug): View
    {
        $services = config('touch2finish.services', []);

        abort_unless(array_key_exists($slug, $services), 404);

        $service = $services[$slug];
        $relatedServices = collect($service['related_services'] ?? [])
            ->filter(fn (string $relatedSlug): bool => $relatedSlug !== $slug && isset($services[$relatedSlug]))
            ->map(fn (string $relatedSlug): array => $services[$relatedSlug])
            ->values()
            ->all();

        return view('service', [
            'service' => $service,
            'relatedServices' => $relatedServices,
            'business' => config('touch2finish.business', []),
        ]);
    }
}
