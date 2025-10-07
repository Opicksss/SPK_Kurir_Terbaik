<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KriteriaController;
use App\Http\Controllers\KurirController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SubKriteriaController;
use App\Http\Controllers\RekapController;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpKernel\Profiler\Profile;

Route::get('/dashboard', function () {
    return view('welcome');
});

Route::middleware(['guest'])->group(function () {
    Route::get('/', [AuthController::class, 'login'])->name('login');

    Route::post('login-proses', [AuthController::class, 'login_proses'])->name('login-proses');
    Route::get('forgot', [AuthController::class, 'forgot'])->name('forgot');
    Route::post('forgot-proses', [AuthController::class, 'forgot_proses'])->name('forgot-proses');
    Route::get('verify-code', [AuthController::class, 'verify_code'])->name('verify-code');
    Route::post('verify-code-proses', [AuthController::class, 'verify_code_proses'])->name('verify-code-proses');
    Route::get('reset-password', [AuthController::class, 'reset_password'])->name('reset-password');
    Route::post('reset-password-proses', [AuthController::class, 'reset_password_proses'])->name('reset-password-proses');
});

Route::middleware(['auth'])->group(function () {
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
    Route::resource('admin', AdminController::class);

    Route::get('kurir', [KurirController::class, 'index'])->name('kurir.index');
    Route::post('kurir/store', [KurirController::class, 'store'])->name('kurir.store');
    Route::get('kurir/{kurir}', [KurirController::class, 'show'])->name('kurir.show');
    Route::put('kurir/{kurir}', [KurirController::class, 'update'])->name('kurir.update');
    Route::delete('kurir/{kurir}', [KurirController::class, 'destroy'])->name('kurir.destroy');

    Route::resource('kriteria', KriteriaController::class);

    Route::get('SubKriteri-{id}', [SubKriteriaController::class, 'index'])->name('subKriteria.index');
    Route::post('SubKriteria/', [SubKriteriaController::class, 'store'])->name('subKriteria.store');
    Route::put('SubKriteria-{id}', [SubKriteriaController::class, 'update'])->name('subKriteria.update');
    Route::delete('SubKriteria-{id}', [SubKriteriaController::class, 'destroy'])->name('subKriteria.destroy');

    Route::resource('rekap', RekapController::class);
    Route::get('rekap-{id}', [RekapController::class, 'detail'])->name('rekap.detail');

    Route::get('profile-{id}', [ProfileController::class, 'profile'])->name('profile');
    Route::post('profile/update', [ProfileController::class, 'updateProfile'])->name('profile.update');
    Route::post('profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password');

    Route::get('topsis', [App\Http\Controllers\TopsisController::class, 'index'])->name('topsis.index');

});
