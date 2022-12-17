<?php

use App\Http\Controllers\PagesController;
use App\Http\Controllers\RedirectsController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PagesController::class, 'index']);

/**
 * All routes should be registered before this
 * The following is a catch-all route
 */

Route::get('/{payload}', RedirectsController::class);
