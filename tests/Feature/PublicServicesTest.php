<?php

use Illuminate\Support\Facades\Route;

it('renders the services overview', function () {
    $this->get(route('services.index'))
        ->assertOk()
        ->assertSee('Professional support for your vehicle, property and move.');
});

$canonicalServices = [
    'mobile-car-valeting' => 'Mobile Car Valeting',
    'domestic-commercial-cleaning' => 'Domestic and Commercial Cleaning',
    'removals-man-and-van' => 'Removals (Man & Van)',
    'handyman-property-maintenance' => 'Handyman and Property Maintenance',
    'refurbishment-decorating' => 'Refurbishment and Decorating',
];

foreach ($canonicalServices as $slug => $title) {
    it("renders the {$title} service page", function () use ($slug, $title) {
        $this->get(route('services.show', ['slug' => $slug]))
            ->assertOk()
            ->assertSee($title);
    });
}

it('returns 404 for an unknown service', function () {
    $this->get('/services/not-a-service')->assertNotFound();
});

$redirects = [
    '/services/car-valeting' => '/services/mobile-car-valeting',
    '/services/cleaning' => '/services/domestic-commercial-cleaning',
    '/services/removals-handyman' => '/services/removals-man-and-van',
    '/services/interior-decor' => '/services/refurbishment-decorating',
    '/services/real-estate' => '/services',
];

foreach ($redirects as $from => $to) {
    it("permanently redirects {$from}", function () use ($from, $to) {
        $this->get($from)->assertStatus(301)->assertRedirect($to);
    });
}

it('publishes only canonical service URLs in the sitemap', function () use ($canonicalServices) {
    $response = $this->get(route('sitemap'))->assertOk();

    $response->assertSee(route('services.index'), false);
    foreach (array_keys($canonicalServices) as $slug) {
        $response->assertSee(route('services.show', ['slug' => $slug]), false);
    }

    foreach (array_keys(config('touch2finish.redirects')) as $oldSlug) {
        $response->assertDontSee('<loc>' . url('/services/' . $oldSlug) . '</loc>', false);
    }
    $response->assertSee(route('areas'), false)->assertSee(route('legal.privacy'), false)
        ->assertSee(route('legal.cookies'), false)->assertSee(route('legal.terms'), false);
});

it('publishes London coverage and the legal information pages', function () {
    $this->get(route('areas'))->assertOk()->assertSee('Areas We Cover')->assertSee('London');
    $this->get(route('legal.privacy'))->assertOk()->assertSee('Privacy Policy');
    $this->get(route('legal.cookies'))->assertOk()->assertSee('Cookie Policy');
    $this->get(route('legal.terms'))->assertOk()->assertSee('Terms and Conditions');
    $this->get(route('home'))->assertOk()->assertSee(route('legal.privacy'), false)
        ->assertSee('London and surrounding locations considered')
        ->assertSee('"areaServed"', false)->assertSee('"name": "London"', false);
});

it('keeps the homepage and quote route available', function () {
    $this->get(route('home'))->assertOk();
    expect(Route::has('quote.submit'))->toBeTrue();
    $this->post(route('quote.submit'), [])->assertRedirect(route('home').'#contact')->assertSessionHasErrors(['name', 'email', 'phone', 'postcode', 'service', 'preferred_contact_method', 'message', 'consent']);
});

it('preselects configured services and ignores invalid query values', function () {
    $this->get(route('home', ['service' => 'mobile-car-valeting']))
        ->assertOk()->assertSee('value="mobile-car-valeting" selected', false);
    $this->get(route('home', ['service' => 'not-a-service']))
        ->assertOk()->assertDontSee('value="not-a-service"', false)->assertDontSee('value="mobile-car-valeting" selected', false);
});

it('preserves the removals URL while using the improved customer-facing name', function () {
    $this->get('/services/removals-man-and-van')->assertOk()
        ->assertSee('Removals (Man &amp; Van)', false)
        ->assertSee('<link rel="canonical" href="'.route('services.show', ['slug' => 'removals-man-and-van']).'">', false);
    $this->get(route('services.index'))->assertOk()->assertSee('Removals (Man &amp; Van)', false);
    $this->get(route('home'))->assertOk()->assertSee('Removals (Man &amp; Van)', false)
        ->assertSee('value="removals-man-and-van"', false)->assertSee('>Removals</a>', false);
});

it('uses the updated quotation and WhatsApp copy on service pages', function () {
    $this->get(route('services.show', ['slug' => 'removals-man-and-van']))->assertOk()
        ->assertSee('You can attach up to four photographs to the quotation form or send additional images through WhatsApp.')
        ->assertSee('WhatsApp Us')->assertDontSee('Call or WhatsApp');
});

it('renders the branded not-found page', function () {
    $this->get('/missing-page')->assertNotFound()->assertSee('We could not find that page.')
        ->assertSee(route('services.index'), false)->assertSee('Explore Our Services');
});

it('does not render missing configured service images and renders available local images', function () {
    $service = config('touch2finish.services.mobile-car-valeting');
    $service['hero_image'] = 'images/services/not-present.webp';
    config(['touch2finish.services.mobile-car-valeting' => $service]);
    $this->get(route('services.show', ['slug' => $service['slug']]))->assertOk()->assertDontSee(asset($service['hero_image']), false);
    $service['hero_image'] = 'images/og-default.jpeg';
    config(['touch2finish.services.mobile-car-valeting' => $service]);
    $this->get(route('services.show', ['slug' => $service['slug']]))->assertOk()->assertSee(asset('images/og-default.jpeg'), false);
});

it('contains no malformed cleaning FAQ text', function () {
    $this->get(route('services.show', ['slug' => 'domestic-commercial-cleaning']))->assertOk()
        ->assertSee('agent’s deposit decision')->assertDontSee('agentÃ');
});
