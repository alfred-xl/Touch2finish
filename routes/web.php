<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

// Homepage
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Dynamic Service Pages — driven by a single template
Route::get('/services/{slug}', [ContactController::class, 'showService'])
    ->name('service.show')
    ->where('slug', '[a-z0-9\-]+');

// Quote form submission
Route::post('/quote', [ContactController::class, 'submitQuote'])
    ->name('quote.submit');

/*
|--------------------------------------------------------------------------
| Authenticated Routes (Breeze — keep for admin access)
|--------------------------------------------------------------------------
*/

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
