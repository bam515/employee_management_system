<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\JoinController;

// 회원가입 폼
Route::get('/', [JoinController::class, 'create'])->name('join');

// 회원가입
Route::post('/', [JoinController::class, 'store'])->name('join.store');
