<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\CardController;

// Guest Dashboard (No login required)
Route::get('/', [GuestController::class, 'index'])->name('home');
Route::get('/guest', [GuestController::class, 'index'])->name('guest.dashboard');

// Authentication Routes (Guest only)
Route::middleware(['guest'])->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

// Logout route (no guest middleware)
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Dashboard Routes (Protected)
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Card routes
    Route::middleware(['auth'])->group(function () {
        Route::get('/cards', [CardController::class, 'index'])->name('cards.index');
        Route::get('/cards/create', [CardController::class, 'create'])->name('cards.create');
        Route::post('/cards', [CardController::class, 'store'])->name('cards.store');
        Route::get('/cards/{id}', [CardController::class, 'show'])->name('cards.show');
        Route::get('/cards/{id}/edit', [CardController::class, 'edit'])->name('cards.edit');
        Route::put('/cards/{id}', [CardController::class, 'update'])->name('cards.update');
        Route::delete('/cards/{id}', [CardController::class, 'destroy'])->name('cards.destroy');
    });
    
    // Public card viewing route (no auth required)
    Route::get('/cards/public/{uniqueId}', [CardController::class, 'publicShow'])->name('cards.public');
});

// Public card viewing route (no auth required)
Route::get('/public/cards/{id}', [CardController::class, 'show'])->name('cards.public');

// Card routes
Route::middleware(['auth'])->group(function () {
    Route::get('/cards', [CardController::class, 'index'])->name('cards.index');
    Route::get('/cards/create', [CardController::class, 'create'])->name('cards.create');
    Route::post('/cards', [CardController::class, 'store'])->name('cards.store');
    Route::get('/cards/{id}', [CardController::class, 'show'])->name('cards.show');
    Route::get('/cards/{id}/edit', [CardController::class, 'edit'])->name('cards.edit');
    Route::put('/cards/{id}', [CardController::class, 'update'])->name('cards.update');
    Route::delete('/cards/{id}', [CardController::class, 'destroy'])->name('cards.destroy');
});

// Public card viewing route (no auth required)
Route::get('/cards/public/{uniqueId}', [CardController::class, 'publicShow'])->name('cards.public');

Auth::routes(['verify' => true]);

Route::get('/email/verify', function () {
    return view('auth.verify');
})->middleware('auth')->name('verification.notice');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
