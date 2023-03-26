<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\LoginController;

// 로그인 페이지
Route::get('/login', [LoginController::class, 'loginForm'])->name('admin.login-form');

// 로그인
Route::post('/login', [LoginController::class, 'login'])->name('admin.login');

// 로그아웃
Route::get('/logout', [LoginController::class, 'logout'])->name('admin.logout');
