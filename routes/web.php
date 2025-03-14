<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontendController;

Route::get('/dC1vLW0tcy1oLWUtcl90LWUtYy1oLW4tby1sLW8tZy1pLWUtcy1wLW8tci10LWYtbw1pLW8tcy==', [FrontendController::class, 'index'])->name('home');
Route::get('/clear-cache', [FrontendController::class, 'clearCache'])->name('clear.cache');
