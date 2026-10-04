<?php

namespace App\Support;

class Seo
{
    /** Canonical identity URLs never depend on the request host or APP_URL. */
    public static function url(string $url = '/'): string
    {
        $path = parse_url($url, PHP_URL_PATH) ?: '/';

        return rtrim(config('touch2finish.business.url'), '/').($path === '/' ? '' : '/'.ltrim($path, '/'));
    }

    public static function route(string $name, array $parameters = []): string
    {
        return self::url(route($name, $parameters, false));
    }

    public static function organizationId(): string
    {
        return self::url().'/#organization';
    }

    public static function socialProfiles(): array
    {
        return array_filter(config('touch2finish.business.social_profiles', []), static fn ($url) => is_string($url) && filter_var($url, FILTER_VALIDATE_URL)
            && parse_url($url, PHP_URL_SCHEME) === 'https'
        );
    }

    public static function areaServed(): array
    {
        return [
            '@type' => 'City',
            'name' => config('touch2finish.service_area.primary'),
            'containedInPlace' => [
                '@type' => 'Country',
                'name' => config('touch2finish.business.country_name'),
            ],
        ];
    }

    public static function homeSchema(string $image): array
    {
        $business = config('touch2finish.business');
        $organization = [
            '@type' => ['Organization', 'LocalBusiness'],
            '@id' => self::organizationId(),
            'name' => $business['name'],
            'legalName' => $business['legal_name'],
            'identifier' => [
                '@type' => 'PropertyValue',
                'propertyID' => 'UK Companies House',
                'value' => $business['company_number'],
            ],
            'url' => self::url(),
            'logo' => ['@type' => 'ImageObject', 'url' => self::url('/images/logo.png')],
            'image' => self::url($image),
            'telephone' => $business['phone_href'],
            'email' => $business['email'],
            'areaServed' => self::areaServed(),
        ];

        if ($profiles = self::socialProfiles()) {
            $organization['sameAs'] = array_values(array_unique($profiles));
        }

        return [
            '@context' => 'https://schema.org',
            '@graph' => [
                $organization,
                [
                    '@type' => 'WebSite',
                    '@id' => self::url().'/#website',
                    'url' => self::url(),
                    'name' => $business['name'],
                    'inLanguage' => 'en-GB',
                    'publisher' => ['@id' => self::organizationId()],
                ],
            ],
        ];
    }

    public static function serviceSchema(array $service, ?string $image): array
    {
        $url = self::route('services.show', ['slug' => $service['slug']]);
        $node = [
            '@type' => 'Service',
            '@id' => $url.'#service',
            'name' => $service['title'],
            'description' => $service['seo_description'],
            'url' => $url,
            'provider' => ['@id' => self::organizationId()],
            'areaServed' => self::areaServed(),
        ];
        if ($image) {
            $node['image'] = self::url($image);
        }

        return [
            '@context' => 'https://schema.org',
            '@graph' => [
                $node,
                [
                    '@type' => 'BreadcrumbList',
                    '@id' => $url.'#breadcrumb',
                    'itemListElement' => [
                        ['@type' => 'ListItem', 'position' => 1, 'name' => 'Home', 'item' => self::route('home')],
                        ['@type' => 'ListItem', 'position' => 2, 'name' => 'Services', 'item' => self::route('services.index')],
                        ['@type' => 'ListItem', 'position' => 3, 'name' => $service['title'], 'item' => $url],
                    ],
                ],
            ],
        ];
    }
}
