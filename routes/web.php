<?php
use App\Http\Controllers\Auth\RegisteredUserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\Auth\SessionController;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return redirect()->route(auth()->check() ? 'applications.index' : 'login');
});

Route::resource('applications', ApplicationController::class)->middleware('auth');
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth')->name('dashboard');

Route::middleware('guest')->group(function () {
Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
Route::post('/register',[RegisteredUserController::class, 'store'])->name('register.store');

Route::get('/login', [SessionController::class, 'create'])->name('login');
Route::post('/login', [SessionController::class,'store'])->name('login.store');
});

Route::post('/logout', [SessionController::class,'destroy'])->middleware('auth')->name('logout');
