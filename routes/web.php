<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\StudentController;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Support\Facades\Route;

Route::get('/', function () { return redirect()->route('login'); });

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    // Limit to 5 login attempts per minute per IP
    Route::post('/login', [AuthController::class, 'login'])->name('login.post')->middleware('throttle:5,1');
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Admin Routes
    Route::middleware(AdminMiddleware::class)->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
        Route::get('/register-student', [AdminController::class, 'showRegister'])->name('register');
        Route::post('/register-student', [AdminController::class, 'registerStudent'])->name('register.post');
        Route::get('/scanner', [AdminController::class, 'showScanner'])->name('scanner');
        
        // Limit scanning to 60 requests per minute to prevent API hammering/DDoS
        Route::post('/scanner/scan', [AdminController::class, 'processScan'])->name('scanner.scan')->middleware('throttle:60,1');
    });

    // Student Routes
    Route::prefix('student')->name('student.')->group(function () {
        Route::get('/dashboard', [StudentController::class, 'dashboard'])->name('dashboard');
    });
});