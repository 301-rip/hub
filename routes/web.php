<?php

use App\Http\Controllers\PagesController;
use App\Http\Controllers\RedirectsController;
use Illuminate\Support\Facades\Route;

Route::middleware('stateless')->group(function (){
    Route::get('/', [PagesController::class, 'index'])->name('home');

    Route::get('/{url}', [RedirectsController::class, 'create'])
        ->where('url', '([Hh][Tt]{2}[Pp][Ss]?:\/\/)?([\w\-]+\.)+([a-zA-Z]{2,63})(\/.*)?')
        ->name('redirects.create');

    Route::get('/v1/{instance}/{path}', [RedirectsController::class, 'show'])
        ->where('instance', '(\\d+|[a-z]{2,})')
        ->where('path', '.+')
        ->name('redirects.show');
});
