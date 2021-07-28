<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::domain(config('app.subdomain_admin'))->name('admin.')->group(function () {

    Route::get('/login', [\App\Http\Controllers\Admin\AuthController::class, 'login'])->name('login.get');
    Route::post('/login', [\App\Http\Controllers\Admin\AuthController::class, 'login'])->name('login.post');
    Route::post('/logout', [\App\Http\Controllers\Admin\AuthController::class, 'logout'])->name('logout');
    Route::middleware('admin.auth')->group(function () {
        Route::get('/', [\App\Http\Controllers\Admin\HomeController::class, 'index']);
        Route::resource('/categories', CategoryController::class);
        Route::get('/search', [\App\Http\Controllers\Admin\CategoryController::class, 'search'])->name('categories.search');
        Route::get('/articles/search', [\App\Http\Controllers\Admin\ArticleController::class, 'search'])->name('articles.search');
        Route::resource('/articles', ArticleController::class);
        Route::get('/series/search', [\App\Http\Controllers\Admin\SeriesController::class, 'search'])->name('series.search');
        Route::resource('/series', SeriesController::class);
        Route::get('/tags/search', [\App\Http\Controllers\Admin\TagController::class, 'search'])->name('tags.search');
        Route::resource('/tags', TagController::class);
    });
});


