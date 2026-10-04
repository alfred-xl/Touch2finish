<?php

use App\Providers\AppServiceProvider;
use Illuminate\Support\Facades\URL;

function seoDocument(string $html): DOMXPath
{
    $document = new DOMDocument;
    $previous = libxml_use_internal_errors(true);
    $document->loadHTML('<?xml encoding="utf-8" ?>'.$html);
    libxml_clear_errors();
    libxml_use_internal_errors($previous);

    return new DOMXPath($document);
}

function seoGraph(string $html): array
{
    $scripts = seoDocument($html)->query('//script[@type="application/ld+json"]');
    expect($scripts->length)->toBe(1);
    $schema = json_decode($scripts->item(0)->textContent, true, 512, JSON_THROW_ON_ERROR);
    expect($schema['@context'])->toBe('https://schema.org');

    return $schema['@graph'];
}

it('identifies the UK business and connects its website without invented details', function () {
    config(['app.name' => 'Laravel', 'app.url' => 'http://localhost']);
    $html = $this->get('/')->assertOk()->getContent();
    [$organization, $website] = seoGraph($html);

    expect($organization['@type'])->toBe(['Organization', 'LocalBusiness'])
        ->and($organization['@id'])->toBe('https://touch2finish.co.uk/#organization')
        ->and($organization['name'])->toBe('Touch2Finish')
        ->and($organization['legalName'])->toBe('Touch2finish Services Ltd')
        ->and($organization['identifier'])->toBe([
            '@type' => 'PropertyValue', 'propertyID' => 'UK Companies House', 'value' => '17277580',
        ])
        ->and($organization['url'])->toBe('https://touch2finish.co.uk')
        ->and($organization['areaServed']['name'])->toBe('London')
        ->and($organization['areaServed']['containedInPlace']['name'])->toBe('United Kingdom')
        ->and($website['@id'])->toBe('https://touch2finish.co.uk/#website')
        ->and($website['publisher'])->toBe(['@id' => $organization['@id']]);

    foreach (['sameAs', 'address', 'geo', 'openingHours', 'foundingDate', 'priceRange', 'vatID', 'review', 'aggregateRating'] as $absent) {
        expect($organization)->not->toHaveKey($absent);
    }
    expect($html)->not->toContain('Official social profiles');
});

it('renders only configured https social profiles in schema and accessible footer links', function () {
    config(['touch2finish.business.social_profiles' => [
        'Example profile' => 'https://social.example.test/touch2finish',
        'Empty' => '', 'Missing' => null, 'Unsafe' => 'javascript:alert(1)',
    ]]);
    $html = $this->get('/')->assertOk()->getContent();
    expect(seoGraph($html)[0]['sameAs'])->toBe(['https://social.example.test/touch2finish']);
    $links = seoDocument($html)->query('//a[@rel="me"]');
    expect($links->length)->toBe(1)
        ->and(trim($links->item(0)->textContent))->toBe('Touch2Finish on Example profile')
        ->and($links->item(0)->getAttribute('href'))->toBe('https://social.example.test/touch2finish');
});

it('publishes one canonical title description and aligned social metadata per page', function (string $path) {
    $response = $this->get($path)->assertOk();
    $document = seoDocument($response->getContent());
    $canonical = 'https://touch2finish.co.uk'.($path === '/' ? '' : $path);

    foreach (['//head/title', '//head/meta[@name="description"]', '//head/link[@rel="canonical"]'] as $selector) {
        expect($document->query($selector)->length)->toBe(1);
    }
    expect($document->query('//head/title')->item(0)->textContent)->toContain('Touch2Finish')
        ->and($document->query('//link[@rel="canonical"]')->item(0)->getAttribute('href'))->toBe($canonical)
        ->and($document->query('//meta[@property="og:url"]')->item(0)->getAttribute('content'))->toBe($canonical)
        ->and($document->query('//meta[@property="og:site_name"]')->item(0)->getAttribute('content'))->toBe('Touch2Finish')
        ->and($document->query('//meta[@property="og:locale"]')->item(0)->getAttribute('content'))->toBe('en_GB')
        ->and($document->query('//meta[@name="robots"]')->item(0)->getAttribute('content'))->toBe('index, follow');

    $image = $document->query('//meta[@property="og:image"]')->item(0)->getAttribute('content');
    $dimensions = getimagesize(public_path(ltrim(parse_url($image, PHP_URL_PATH), '/')));
    expect($document->query('//meta[@property="og:image:width"]')->item(0)->getAttribute('content'))->toBe((string) $dimensions[0])
        ->and($document->query('//meta[@property="og:image:height"]')->item(0)->getAttribute('content'))->toBe((string) $dimensions[1]);
})->with(['/', '/about', '/services', '/areas-we-cover', '/privacy-policy', '/cookie-policy', '/terms-and-conditions', '/services/mobile-car-valeting', '/services/domestic-commercial-cleaning', '/services/removals-man-and-van', '/services/handyman-property-maintenance', '/services/refurbishment-decorating']);

it('canonicalizes quote and tracking variants while preserving service selection', function () {
    $response = $this->get('/?service=mobile-car-valeting&utm_source=test')->assertOk()
        ->assertSee('value="mobile-car-valeting" selected', false);
    $document = seoDocument($response->getContent());
    expect($document->query('//link[@rel="canonical"]')->item(0)->getAttribute('href'))->toBe('https://touch2finish.co.uk')
        ->and($document->query('//meta[@property="og:url"]')->item(0)->getAttribute('content'))->toBe('https://touch2finish.co.uk');
});

it('connects each service and its breadcrumbs to canonical identity URLs', function (string $slug) {
    $html = $this->get('/services/'.$slug)->assertOk()->getContent();
    [$service, $breadcrumbs] = seoGraph($html);
    expect($service['@type'])->toBe('Service')
        ->and($service['name'])->toBe(config('touch2finish.services.'.$slug.'.title'))
        ->and($service['url'])->toBe('https://touch2finish.co.uk/services/'.$slug)
        ->and($service['provider'])->toBe(['@id' => 'https://touch2finish.co.uk/#organization'])
        ->and($service['areaServed']['name'])->toBe('London')
        ->and($breadcrumbs['@type'])->toBe('BreadcrumbList')
        ->and(array_column($breadcrumbs['itemListElement'], 'position'))->toBe([1, 2, 3])
        ->and(array_column($breadcrumbs['itemListElement'], 'item'))->toBe([
            'https://touch2finish.co.uk', 'https://touch2finish.co.uk/services', $service['url'],
        ])
        ->and($breadcrumbs['itemListElement'][2]['name'])->toBe($service['name']);
})->with(['mobile-car-valeting', 'domestic-commercial-cleaning', 'removals-man-and-van', 'handyman-property-maintenance', 'refurbishment-decorating']);

it('keeps all public production URLs on the configured canonical host despite a wrong APP_URL', function (string $host) {
    config(['app.env' => 'production', 'app.url' => 'http://touch2finish.net']);
    (new AppServiceProvider($this->app))->boot();

    foreach (['/', '/about', '/services', '/services/mobile-car-valeting', '/areas-we-cover'] as $path) {
        $html = $this->get('http://'.$host.$path)->assertOk()->getContent();
        $document = seoDocument($html);
        foreach ($document->query('//@href | //@src | //meta[@property="og:url"]/@content | //meta[@property="og:image"]/@content') as $attribute) {
            $value = $attribute->nodeValue;
            if (str_contains($value, 'touch2finish') && str_starts_with($value, 'http')) {
                expect(parse_url($value, PHP_URL_HOST))->toBe('touch2finish.co.uk')
                    ->and(parse_url($value, PHP_URL_SCHEME))->toBe('https');
            }
        }
        expect($html)->not->toContain('http://localhost', 'http://touch2finish', 'https://www.touch2finish', 'touch2finish.net', 'touch2finish.com');
    }
})->with(['localhost', 'www.touch2finish.co.uk', 'touch2finish.net', 'touch2finish.com']);

it('publishes precisely the canonical public pages in valid XML', function () {
    config(['app.env' => 'production', 'app.url' => 'http://localhost']);
    (new AppServiceProvider($this->app))->boot();
    $response = $this->get('http://www.touch2finish.co.uk/sitemap.xml')->assertOk()
        ->assertHeader('Content-Type', 'application/xml; charset=UTF-8');
    $xml = new SimpleXMLElement($response->getContent());
    $actual = array_map(fn ($entry) => (string) $entry->loc, iterator_to_array($xml->url, false));
    $expected = array_map(fn ($path) => 'https://touch2finish.co.uk'.$path, [
        '', '/about', '/services', '/areas-we-cover', '/privacy-policy', '/cookie-policy', '/terms-and-conditions',
        '/services/mobile-car-valeting', '/services/domestic-commercial-cleaning', '/services/removals-man-and-van',
        '/services/handyman-property-maintenance', '/services/refurbishment-decorating',
    ]);
    sort($actual);
    sort($expected);
    expect($actual)->toBe($expected);
});

it('keeps 404s noindex and future locations unpublished', function () {
    config(['touch2finish.locations' => ['example-area' => ['name' => 'Example area', 'slug' => 'example-area']]]);
    foreach (['/missing-page', '/services/not-a-service', '/areas-we-cover/example-area'] as $path) {
        $html = $this->get($path)->assertNotFound()->getContent();
        expect(seoDocument($html)->query('//meta[@name="robots"]')->item(0)->getAttribute('content'))->toBe('noindex, follow');
    }
    $this->get('/sitemap.xml')->assertDontSee('example-area');
});

it('links company identity and coverage from the public content', function () {
    foreach (['/', '/about', '/services', '/areas-we-cover', '/services/mobile-car-valeting'] as $path) {
        $html = $this->get($path)->assertOk()->assertSee('Touch2finish Services Ltd')->assertSee('17277580')->getContent();
        $document = seoDocument($html);
        foreach ([route('about'), route('areas'), route('services.index'), route('home').'#contact'] as $href) {
            expect($document->query('//a[@href="'.$href.'"]')->length)->toBeGreaterThan(0);
        }
    }
});

it('preserves public crawling and the production sitemap in the static robots file', function () {
    $robots = file_get_contents(public_path('robots.txt'));
    expect($robots)->toContain('User-agent: *', 'Allow: /', 'Sitemap: https://touch2finish.co.uk/sitemap.xml')
        ->not->toMatch('/Disallow:\s*\/(?:services|about|areas-we-cover|images|build|css|js)(?:\s|\/|$)/m');
});

it('has working internal page and fragment links across the sitemap pages', function () {
    $xml = new SimpleXMLElement($this->get('/sitemap.xml')->assertOk()->getContent());
    $documents = [];
    $load = function (string $path) use (&$documents): DOMXPath {
        if (! isset($documents[$path])) {
            $documents[$path] = seoDocument($this->get($path)->assertOk()->getContent());
        }

        return $documents[$path];
    };
    $localHost = parse_url(route('home'), PHP_URL_HOST);

    foreach ($xml->url as $entry) {
        $path = parse_url((string) $entry->loc, PHP_URL_PATH) ?: '/';
        foreach ($load($path)->query('//a[@href]') as $link) {
            $href = $link->getAttribute('href');
            $scheme = parse_url($href, PHP_URL_SCHEME);
            $host = parse_url($href, PHP_URL_HOST);
            if (($scheme && ! in_array($scheme, ['http', 'https'], true)) || ($host && ! in_array($host, [$localHost, 'touch2finish.co.uk'], true))) {
                continue;
            }
            $target = parse_url($href, PHP_URL_PATH) ?: ($host ? '/' : $path);
            $targetDocument = $load($target);
            if ($fragment = parse_url($href, PHP_URL_FRAGMENT)) {
                $ids = [];
                foreach ($targetDocument->query('//*[@id]') as $element) {
                    $ids[] = $element->getAttribute('id');
                }
                expect($ids)->toContain(rawurldecode($fragment));
            }
        }
    }
});

it('encodes configured schema text without allowing an HTML script breakout', function () {
    $name = 'Touch2Finish </script><script>alert("test")</script>';
    config(['touch2finish.business.name' => $name]);
    $html = $this->get('/')->assertOk()->getContent();
    expect(seoGraph($html)[0]['name'])->toBe($name)
        ->and($html)->not->toContain('<script>alert("test")</script>');
});

afterEach(function () {
    URL::forceRootUrl(null);
    URL::forceScheme(null);
});
