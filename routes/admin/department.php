<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DepartmentController;

// 부서관리 index
Route::get('/', [DepartmentController::class, 'index'])->name('admin.department.index');

// 부서 생성 폼
Route::get('/create', [DepartmentController::class, 'create'])->name('admin.department.create');

// 부서 생성
Route::post('/', [DepartmentController::class, 'store'])->name('admin.department.store');

// 부서 수정 폼
Route::get('/{department}', [DepartmentController::class, 'edit'])->name('admin.department.edit');

// 부서 수정
Route::put('/{department}', [DepartmentController::class, 'update'])->name('admin.department.update');

// 부서 삭제
Route::delete('/{department}', [DepartmentController::class, 'delete'])->name('admin.department.delete');
