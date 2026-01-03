<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PenilaianController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PenilaianController as AdminPenilaianController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

// Manual Authentication Routes
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);

// Home Route
Route::get('/home', function () {
    if (Auth::check()) {
        if (Auth::user()->isAdmin()) {
            return redirect()->route('admin.dashboard');
        }
        return redirect()->route('penilaian.create');
    }
    return redirect('/');
})->name('home');

// Public Routes
Route::get('/', function () {
    if (Auth::check()) {
        if (Auth::user()->isAdmin()) {
            return redirect()->route('admin.dashboard');
        }
        return redirect()->route('penilaian.create');
    }
    return view('welcome');
});

// Public Penilaian Routes (untuk user biasa)
Route::get('/penilaian', [PenilaianController::class, 'index'])->name('penilaian.index');
Route::get('/penilaian/create', [PenilaianController::class, 'create'])->name('penilaian.create');
Route::post('/penilaian', [PenilaianController::class, 'store'])->name('penilaian.store');

// Admin Routes Group
Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    
    // Route resource dengan nama yang benar
    Route::resource('penilaian', AdminPenilaianController::class)->names([
        'index' => 'admin.penilaian.index',
        'create' => 'admin.penilaian.create',
        'store' => 'admin.penilaian.store',
        'show' => 'admin.penilaian.show',
        'edit' => 'admin.penilaian.edit',
        'update' => 'admin.penilaian.update',
        'destroy' => 'admin.penilaian.destroy'
    ]);
    
    Route::get('/statistik', [AdminPenilaianController::class, 'statistik'])->name('admin.statistik');
    Route::get('/saw', [AdminPenilaianController::class, 'saw'])->name('admin.saw');
    
    Route::get('/', function () {
        return redirect()->route('admin.dashboard');
    });
});