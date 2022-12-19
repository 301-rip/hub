<?php

use App\Http\Controllers\PagesController;
use App\Http\Controllers\RedirectsController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PagesController::class, 'index'])->name('home');

/**
 * All routes should be registered before this
 * The following is a catch-all route
 */

// @todo - route naming reckoning once we figure out what is actually happening

Route::get('/redirect', function () {
    return session('redirect');
})->name('redirects.show');

Route::get('/{instance}/{user?}/{post?}', RedirectsController::class)->name('redirect');

Route::domain('{domain}')->group(function () {
    Route::get('/{user?}/{post?}', fn() => null)->name('redirects.external');
});