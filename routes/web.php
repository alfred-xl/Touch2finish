<?php

use App\Http\Controllers\QuoteRequestController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\SitemapController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('home');
Route::view('/areas-we-cover', 'areas-we-cover')->name('areas');
Route::view('/privacy-policy', 'legal.privacy-policy')->name('legal.privacy');
Route::view('/cookie-policy', 'legal.cookie-policy')->name('legal.cookies');
Route::view('/terms-and-conditions', 'legal.terms-and-conditions')->name('legal.terms');

Route::get('/services', [ServiceController::class, 'index'])->name('services.index');

foreach (config('touch2finish.redirects', []) as $oldSlug => $newSlug) {
    Route::permanentRedirect(
        '/services/' . $oldSlug,
        $newSlug ? '/services/' . $newSlug : '/services'
    );
}
Route::get('/services/{slug}', [ServiceController::class, 'show'])
    ->name('services.show')
    ->where('slug', '[a-z0-9\-]+');

Route::post('/quote', [QuoteRequestController::class, 'store'])
    ->middleware('throttle:5,1')
    ->name('quote.submit');

Route::get('/sitemap.xml', [SitemapController::class, 'index'])->name('sitemap');
