<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RatingController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('news/{article}', [HomeController::class, 'show'])->name('news.show');

route::get('/login', [\App\Http\Controllers\AuthController::class, 'loginIndex'])->name('login.index');
route::get('/register', [\App\Http\Controllers\AuthController::class, 'registerIndex'])->name('register.index');
route::post('/login', [\App\Http\Controllers\AuthController::class, 'login'])->name('login.auth');
route::post('/register', [\App\Http\Controllers\AuthController::class, 'register'])->name('register.auth');
route::get('/logout', [\App\Http\Controllers\AuthController::class, 'logout'])->name('logout');

Route::get('/about', [\App\Http\Controllers\AboutController::class, 'index'])->name('about');
Route::get('/mission', [\App\Http\Controllers\AboutController::class, 'mission'])->name('mission');

Route::get('/movie', [\App\Http\Controllers\MovieController::class, 'index'])->name('movie.index');
Route::get('/movie/{movie}', [\App\Http\Controllers\MovieController::class, 'show'])->name('movie.show');


Route::post('/movies/{movie}/rate', [RatingController::class, 'store'])->name('movies.rate');

route::get('/cms', [\App\Http\Controllers\CMSController::class, 'index'])->name('cms.index');

Route::name('cms.')->prefix('cms')->group(function () {

   Route::get('/article', [\App\Http\Controllers\CMSController::class, 'article'])->name('article');
    Route::get('/article/create', [\App\Http\Controllers\ArticleController::class, 'create'])->name('article.create');
    Route::post('/article', [\App\Http\Controllers\ArticleController::class, 'store'])->name('article.store');
    Route::get('/article/{article}/edit', [\App\Http\Controllers\ArticleController::class, 'edit'])->name('article.edit');
    Route::post('/article/{article}', [\App\Http\Controllers\ArticleController::class, 'update'])->name('article.update');
    Route::delete('/articles/{article}', [\App\Http\Controllers\ArticleController::class, 'destroy'])->name('article.destroy');

   Route::get('/special', [\App\Http\Controllers\CMSController::class, 'special'])->name('special');

   Route::get('/movie', [\App\Http\Controllers\CMSController::class, 'movie'])->name('movie');
   Route::get('/movie/create', [\App\Http\Controllers\MovieController::class, 'create'])->name('movie.create');
   Route::post('/movie', [\App\Http\Controllers\MovieController::class, 'store'])->name('movie.store');
   Route::get('/movie/{movie}/edit', [\App\Http\Controllers\MovieController::class, 'edit'])->name('movie.edit');
   Route::post('/movie/{movie}', [\App\Http\Controllers\MovieController::class, 'update'])->name('movie.update');
   Route::delete('/movie/{movie}', [\App\Http\Controllers\MovieController::class, 'destroy'])->name('movie.destroy');
});
