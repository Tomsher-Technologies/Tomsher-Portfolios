<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontendController;
use Illuminate\Http\Request;
use App\Models\User;

Route::get('/', [FrontendController::class, 'login'])->name('home');
Route::get('/clear-cache', [FrontendController::class, 'clearCache'])->name('clear.cache');


Route::post('/check-email', function (Request $request) {
    $email = $request->input('email');

    // Check if email exists in the database
    if (User::where('email', $email)->exists()) {
        // Store email in session to allow access
        Session::put('verified_email', $email);
        return response()->json(['status' => 'success', 'redirect' => url('/portfolios')]);
    }

    return response()->json(['status' => 'error', 'message' => 'Access denied. Email not found.']);
});

Route::get('/portfolios', [FrontendController::class, 'index'])->name('home.portfolios');

Route::get('/logout', function () {
    Session::forget('verified_email');
    return redirect('/');
})->name('logout');