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

Route::get('/{url}', [RedirectsController::class, 'create'])
	->where('url', '([Hh][Tt]{2}[Pp][Ss]?:\/\/)?([\w\-]+\.)+([a-zA-Z]{2,63})(\/.*)?')
	->name('redirects.create');

Route::get('/{instance}/{path}', [RedirectsController::class, 'show'])
	->where('instance', '(\\d+|[a-z]{2,})')
	->where('path', '.+')
	->name('redirects.show');

Route::domain('{domain}')->group(function () {
    Route::get('/{user?}/{post?}', fn() => null)->name('redirects.external');
});
