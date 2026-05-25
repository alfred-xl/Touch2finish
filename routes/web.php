<?php
// ──────────────────────────────────────────────────────────────────────────────
// FILE: routes/web.php  (replace existing file with this content)
//
// Changes from original:
//  - Added /sitemap.xml route → SitemapController@index
//  - All other routes unchanged
// ──────────────────────────────────────────────────────────────────────────────

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SitemapController;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

// Homepage
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Dynamic Service Pages
Route::get('/services/{slug}', [ContactController::class, 'showService'])
    ->name('service.show')
    ->where('slug', '[a-z0-9\-]+');

// Quote form submission
Route::post('/quote', [ContactController::class, 'submitQuote'])
    ->middleware('throttle:5,1')
    ->name('quote.submit');

// XML Sitemap
Route::get('/sitemap.xml', [SitemapController::class, 'index'])
    ->name('sitemap');

/*
|--------------------------------------------------------------------------
| Authenticated Routes (Breeze)
|--------------------------------------------------------------------------
*/
