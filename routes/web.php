<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CaseController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\SitemapController;


// Главная
Route::get('/', [HomeController::class, 'index'])
    ->name('home');


// Формы
Route::post('/contact', [ContactController::class, 'store'])
    ->middleware('throttle:5,1')
    ->name('contact.store');


// Юридические страницы
Route::view('/policy', 'pages.legal.policy')
    ->name('policy');

Route::view('/cookies', 'pages.legal.cookies')
    ->name('cookies');


// Sitemap
Route::get('/sitemap.xml', [SitemapController::class, 'index'])
    ->name('sitemap');


// Услуги
Route::prefix('services')
    ->name('services.')
    ->group(function () {

        Route::get('/', [ServiceController::class, 'index'])
            ->name('index');

        Route::get('/{slug}', [ServiceController::class, 'show'])
            ->name('show');
    });


// Кейсы
Route::get('/cases', [PageController::class, 'cases'])
    ->name('cases');

Route::get('/cases/{slug}', [CaseController::class, 'show'])
    ->name('cases.show');


// Блог
Route::prefix('blog')
    ->name('blog.')
    ->group(function () {

        Route::get('/', [BlogController::class, 'index'])
            ->name('index');

        Route::get('/{slug}', [BlogController::class, 'show'])
            ->name('show');
    });


// Аутентификация
Route::get('/login', [AuthController::class, 'showLoginForm'])
    ->name('login');

Route::post('/login', [AuthController::class, 'login']);

Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout');


// Динамические страницы из БД
// ВАЖНО: маршрут должен оставаться последним.
Route::get('/{slug}', [PageController::class, 'show'])
    ->name('page.show');