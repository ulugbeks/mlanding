<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\AdminBlogController;
use App\Http\Controllers\Backend\SeoController;
use App\Http\Controllers\Auth\LoginController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

// Frontend routes with localization
Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
], function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/blogs', [BlogController::class, 'index'])->name('blogs.index');
    Route::get('/blog/{slug}', [BlogController::class, 'show'])->name('blogs.show');
});

// Authentication routes
Route::get('/backend/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/backend/login', [LoginController::class, 'login']);
Route::post('/backend/logout', [LoginController::class, 'logout'])->name('logout');

// Backend routes (with authentication)
Route::prefix('backend')->middleware(['auth'])->group(function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    
    // Blog management
    Route::resource('blogs', AdminBlogController::class)->names('admin.blogs');
    
    // SEO settings
    Route::get('seo', [SeoController::class, 'index'])->name('admin.seo.index');
    Route::post('seo', [SeoController::class, 'update'])->name('admin.seo.update');
});