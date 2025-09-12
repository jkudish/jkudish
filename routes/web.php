<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\SitemapController;
use Illuminate\Support\Facades\Route;

// redirect slides subdomain to speaking
Route::domain('slides.jkudish.com')->group(function () {
    Route::redirect('/', 'https://jkudish.com/speaking');
    Route::fallback(fn () => redirect('/speaking'));
});

Route::middleware('cache.headers:public;max_age=2628000;etag')->group(function () {
    Route::view('/', 'home')->name('home');
    Route::view('/speaking', 'speaking')->name('speaking');
    Route::view('/services', 'services')->name('services');
    Route::view('/projects', 'projects')->name('projects');
    Route::view('/newsletter', 'newsletter')->name('newsletter');
    Route::get('/contact', [ContactController::class, 'show'])->name('contact');
});

Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

Route::redirect('/presents', '/speaking');
Route::redirect('/slides', '/speaking');
Route::redirect('/presentations', '/speaking');
Route::redirect('/presented', '/speaking');

Route::redirect('/found', 'https://found.jkudish.com');

// Sitemap
Route::get('/sitemap.xml', [SitemapController::class, 'index'])->name('sitemap');
