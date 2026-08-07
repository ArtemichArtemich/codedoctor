<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CaseController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\SitemapController;

// Главная
Route::get('/', [HomeController::class, 'index'])->name('home');

// Отправка форм
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// Статические страницы
Route::view('/policy', 'pages.legal.policy')->name('policy');
Route::view('/cookies', 'pages.legal.cookies')->name('cookies');

// Sitemap
Route::get('/sitemap.xml', [SitemapController::class, 'index'])->name('sitemap');

Route::prefix('services')->name('services.')->group(function () {
    Route::get('/', [App\Http\Controllers\ServiceController::class, 'index'])->name('index');
    Route::get('/{slug}', [App\Http\Controllers\ServiceController::class, 'show'])->name('show');
});

// Кейсы
Route::get('/cases', [PageController::class, 'cases'])->name('cases'); // Страница со списком кейсов
Route::get('/cases/{slug}', [CaseController::class, 'show'])->name('cases.show'); // Детальная страница кейса

// Аутентификация
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Динамические страницы из БД (В САМОМ КОНЦЕ!)
Route::get('/{slug}', [PageController::class, 'show'])->name('page.show');
