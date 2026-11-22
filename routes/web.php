<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class)->name('home');
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/appearances', [PageController::class, 'appearances'])->name('appearances');
Route::get('/{slug}', [PostController::class, 'show'])
    ->where('slug', '^[a-z0-9]+(?:-[a-z0-9]+)*$')
    ->name('posts.show');
