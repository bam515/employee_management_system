<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Employee\AccessController;
use App\Http\Controllers\Admin\Employee\WaitController;

// 직원관리 > 현재 직원 - index
Route::get('/access', [AccessController::class, 'index'])->name('admin.employee.access');

// 직원관리 > 대기 직원 - index
Route::get('/wait', [WaitController::class, 'index'])->name('admin.employee.wait');

