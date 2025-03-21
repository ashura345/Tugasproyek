<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

// Halaman utama (landing page)
Route::get('/', function () {
    return view('landing'); // Halaman yang ditampilkan adalah landing.blade.php
});

// Route Autentikasi (Login, Register, Logout)
Route::controller(AuthController::class)->group(function () {
    Route::get('/login', 'showLoginForm')->name('login');
    Route::post('/login', 'login');
    Route::get('/register', 'showRegisterForm')->name('register');
    Route::post('/register', 'register');
    Route::post('/logout', 'logout')->name('logout');

    // Google Authentication
    Route::get('/auth/google', 'redirectToGoogle')->name('google.redirect');
    Route::get('/auth/google/callback', 'handleGoogleCallback')->name('google.callback');
});

// Grup Middleware Auth untuk rute yang membutuhkan autentikasi
Route::middleware(['auth'])->group(function () {

    // Dashboard Route
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Payment Routes
    Route::prefix('payment')->group(function () {
        Route::get('/spp', [PaymentController::class, 'spp'])->name('payment.spp');
        Route::get('/seragam', [PaymentController::class, 'seragam'])->name('payment.seragam');
        Route::get('/ijazah', [PaymentController::class, 'ijazah'])->name('payment.ijazah');
    });

    // Chart data API Route
    Route::get('/chart-data', [DashboardController::class, 'chartData'])->name('chart.data');

    // Profile Routes
    Route::prefix('profile')->group(function () {
        Route::get('/', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });
});

// Memuat route autentikasi tambahan
require __DIR__.'/auth.php';
