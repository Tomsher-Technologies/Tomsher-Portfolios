<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TechnologyController;
use App\Http\Controllers\IndustryController;
use App\Http\Controllers\PortfolioController;

Route::group(['middleware' => ['guest']], function () {
    Route::get('login', [AuthController::class, 'showLoginForm'])->name('admin.login');
    Route::post('login', [AuthController::class, 'login']);
});

Route::get('/', [AuthController::class, 'showLoginForm'])->name('home');
Route::get('logout', [AuthController::class, 'logout'])->name('admin.logout');

Route::group(['middleware' => ['auth']], function () {

    Route::get('/', [AdminController::class, 'admin_dashboard'])->name('admin.dashboard');
    Route::get('/cache-cache', [AdminController::class, 'clearCache'])->name('cache.clear');

    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::post('/categories/store', [CategoryController::class, 'store'])->name('categories.store');
    Route::post('/categories/update/{id}', [CategoryController::class, 'update'])->name('categories.update');
    Route::post('/category/status', [CategoryController::class, 'updateStatus'])->name('categories.status');
    Route::get('/categories/delete/{id}', [CategoryController::class, 'destroy'])->name('categories.destroy');

    Route::get('/technologies', [TechnologyController::class, 'index'])->name('technologies.index');
    Route::post('/technologies/store', [TechnologyController::class, 'store'])->name('technologies.store');
    Route::post('/technologies/update/{id}', [TechnologyController::class, 'update'])->name('technologies.update');
    Route::post('/technologies/status', [TechnologyController::class, 'updateStatus'])->name('technologies.status');
    Route::get('/technologies/delete/{id}', [TechnologyController::class, 'destroy'])->name('technologies.destroy');

    Route::get('/industries', [IndustryController::class, 'index'])->name('industries.index');
    Route::post('/industries/store', [IndustryController::class, 'store'])->name('industries.store');
    Route::post('/industries/update/{id}', [IndustryController::class, 'update'])->name('industries.update');
    Route::post('/industries/status', [IndustryController::class, 'updateStatus'])->name('industries.status');
    Route::get('/industries/delete/{id}', [IndustryController::class, 'destroy'])->name('industries.destroy');

    Route::get('/portfolios', [PortfolioController::class, 'index'])->name('portfolios.index');
    Route::get('/portfolios/create', [PortfolioController::class, 'create'])->name('portfolios.create');
    Route::post('/portfolios/store', [PortfolioController::class, 'store'])->name('portfolios.store');
    Route::get('/portfolios/edit/{id}', [PortfolioController::class, 'edit'])->name('portfolios.edit');
    Route::post('/portfolios/update/{id}', [PortfolioController::class, 'update'])->name('portfolios.update');
    Route::post('/portfolios/status', [PortfolioController::class, 'updateStatus'])->name('portfolios.status');
    Route::get('/portfolios/delete/{id}', [PortfolioController::class, 'destroy'])->name('portfolios.destroy');



});