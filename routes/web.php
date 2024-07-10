<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'home')->name('home');

Route::view('/speaking', 'speaking')->name('speaking');
Route::redirect('/presents', '/speaking');
Route::redirect('/slides', '/speaking');
Route::redirect('/presentations', '/speaking');
Route::redirect('/presented', '/speaking');

// redirect slides subdomain to speaking
Route::domain('slides.jkudish.com')->group(function () {
    Route::fallback(redirect('/speaking'));
});

Route::redirect('/found', 'https://found.jkudish.com');

