<?php

use Illuminate\Support\Facades\Route;

// redirect slides subdomain to speaking
Route::domain('slides.jkudish.com')->group(function () {
    Route::redirect('/', 'https://jkudish.com/speaking');
    Route::fallback(fn () => redirect('/speaking'));
});

Route::middleware('cache.headers:public;max_age=2628000;etag')->group(function () {
    Route::view('/', 'home')->name('home');
    Route::view('/speaking', 'speaking')->name('speaking');
});

Route::redirect('/presents', '/speaking');
Route::redirect('/slides', '/speaking');
Route::redirect('/presentations', '/speaking');
Route::redirect('/presented', '/speaking');

Route::redirect('/found', 'https://found.jkudish.com');
