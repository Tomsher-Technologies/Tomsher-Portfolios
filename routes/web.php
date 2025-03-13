<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontendController;

Route::get('/', [FrontendController::class, 'index'])->name('home');
Route::get('/clear-cache', [FrontendController::class, 'clearCache'])->name('clear.cache');
