<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::domain(config('app.main_domain'))->name('web.')->group(function () {
    Route::get('', [\App\Http\Controllers\Web\HomeController::class, 'index'])->name('home');
    Route::resource('/articles', ArticlesController::class);
    Route::resource('/articles-view-log', ArticleViewLogController::class);
});

Route::group(['prefix' => 'filemanager', 'middleware' => ['web', 'admin.auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});

