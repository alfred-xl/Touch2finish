<?php

use App\Jobs\SendQuoteRequestNotifications;
use App\Mail\QuoteRequestMail;
use App\Mail\QuoteRequestReceivedMail;
use App\Models\QuoteRequest;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\Facades\Storage;

function validQuote(array $overrides = []): array
{
    return array_merge(['name'=>'Test Customer','email'=>'customer@example.com','phone'=>'+44 7700 900000',
        'postcode'=>'SW1A 1AA','service'=>'mobile-car-valeting','preferred_date'=>now()->addWeek()->toDateString(),
        'preferred_contact_method'=>'whatsapp','message'=>'Please provide a detailed quotation for this work.','consent'=>'1'], $overrides);
}

beforeEach(function () { Mail::fake(); Queue::fake(); Storage::fake('local'); });

it('stores a valid request with trusted data reference and consent', function () {
    $this->post(route('quote.submit'), validQuote())->assertRedirect(route('home').'#contact')->assertSessionHas('quote_success');
    $quote=QuoteRequest::first();
    expect($quote->reference)->toMatch('/^T2F-\d{8}-[A-Z0-9]{6}$/')->and($quote->service_title)->toBe('Mobile Car Valeting')
        ->and($quote->consent_at)->not->toBeNull()->and($quote->preferred_contact_method)->toBe('whatsapp')
        ->and($quote->preferred_date->toDateString())->toBe(now()->addWeek()->toDateString());
    Queue::assertPushed(SendQuoteRequestNotifications::class, fn ($job) => $job->quoteRequest->is($quote));
    expect($quote->notification_status)->toBe('pending');
});

it('stores only relevant nonempty service details', function () {
    $this->post(route('quote.submit'), validQuote(['vehicle_make_model'=>'Ford Transit','vehicle_size'=>'van','property_type'=>'house']));
    expect(QuoteRequest::first()->service_details)->toBe(['vehicle_make_model'=>'Ford Transit','vehicle_size'=>'van']);
});

it('stores photographs privately and creates attachment records', function () {
    $png=base64_decode('iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mNk+A8AAQUBAScY42YAAAAASUVORK5CYII=');
    $this->post(route('quote.submit'), validQuote(['photos'=>[UploadedFile::fake()->createWithContent('room.png',$png),UploadedFile::fake()->createWithContent('van.png',$png)]]))->assertSessionHasNoErrors();
    $quote=QuoteRequest::first(); expect($quote->attachments)->toHaveCount(2);
    $quote->attachments->each(fn($file)=>Storage::disk('local')->assertExists($file->stored_path));
    expect($quote->attachments->first()->stored_path)->not->toContain('room.png');
    $attachments=(new QuoteRequestMail($quote->load('attachments')))->attachments();
    expect($attachments)->toHaveCount(2)
        ->and(collect($attachments)->pluck('as')->sort()->values()->all())->toBe(['room.png','van.png']);
});

it('the queued job sends internal and customer mail with the persisted request', function () {
    $this->post(route('quote.submit'), validQuote()); $quote=QuoteRequest::first();
    (new SendQuoteRequestNotifications($quote))->handle();
    Mail::assertSent(QuoteRequestMail::class, fn($mail)=>$mail->quoteRequest->is($quote) && $mail->hasTo('info@touch2finish.co.uk') && $mail->hasReplyTo($quote->email));
    Mail::assertSent(QuoteRequestReceivedMail::class, fn($mail)=>$mail->quoteRequest->is($quote) && $mail->hasTo($quote->email) && $mail->attachments()===[]);
    expect($quote->fresh()->notification_status)->toBe('sent');
});

it('the queued job records internal notification failure without losing the request', function () {
    $png=base64_decode('iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mNk+A8AAQUBAScY42YAAAAASUVORK5CYII=');
    $this->post(route('quote.submit'), validQuote(['photos'=>[UploadedFile::fake()->createWithContent('evidence.png',$png)]])); $quote=QuoteRequest::first();
    Mail::shouldReceive('to')->andThrow(new RuntimeException('Test transport failure'));
    (new SendQuoteRequestNotifications($quote))->handle();
    expect($quote->fresh())->not->toBeNull()->and($quote->fresh()->notification_status)->toBe('failed')
        ->and($quote->attachments()->count())->toBe(1);
});

it('skips a missing persisted attachment without blocking available attachments', function () {
    Log::spy();
    $png=base64_decode('iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mNk+A8AAQUBAScY42YAAAAASUVORK5CYII=');
    $this->post(route('quote.submit'), validQuote(['photos'=>[UploadedFile::fake()->createWithContent('one.png',$png),UploadedFile::fake()->createWithContent('two.png',$png)]]));
    $quote=QuoteRequest::first()->load('attachments');
    Storage::disk('local')->delete($quote->attachments->first()->stored_path);
    expect((new QuoteRequestMail($quote))->attachments())->toHaveCount(1);
    Log::shouldHaveReceived('warning')->once()->withArgs(fn ($message, $context) => $message === 'Quote mail attachment is missing' && $context['reference'] === $quote->reference);
});

it('shows the success dialog only after a successful submission', function () {
    $this->get(route('home'))->assertOk()->assertDontSee('quote-success-title');
    $response=$this->followingRedirects()->post(route('quote.submit'), validQuote());
    $response->assertOk()->assertSee('<dialog', false)->assertSee('quote-success-title')->assertSee(QuoteRequest::first()->reference);
});

it('does not show the success dialog after validation fails', function () {
    $this->followingRedirects()->post(route('quote.submit'), validQuote(['consent'=>null]))
        ->assertOk()->assertDontSee('quote-success-title');
});

it('rejects invalid service past dates missing consent and honeypot', function (array $changes, array $errors) {
    $this->post(route('quote.submit'), validQuote($changes))->assertRedirect(route('home').'#contact')->assertSessionHasErrors($errors);
})->with([
    'invalid service'=>[['service'=>'invalid'],['service']], 'past date'=>[['preferred_date'=>now()->subDay()->toDateString()],['preferred_date']],
    'missing consent'=>[['consent'=>null],['consent']], 'honeypot'=>[['website'=>'spam'],['website']],
]);

it('rejects more than four photographs and unsafe files', function () {
    $files=collect(range(1,5))->map(fn($n)=>UploadedFile::fake()->create("$n.jpg",10,'image/jpeg'))->all();
    $this->post(route('quote.submit'), validQuote(['photos'=>$files]))->assertSessionHasErrors('photos');
    $this->post(route('quote.submit'), validQuote(['photos'=>[UploadedFile::fake()->create('script.php',10,'application/x-php')]]))->assertSessionHasErrors('photos.0');
});

it('keeps the quote endpoint rate limited', function () {
    foreach(range(1,5) as $_) $this->post(route('quote.submit'), []);
    $this->post(route('quote.submit'), [])->assertTooManyRequests();
});
