<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\NoticeController;

// 공지사항 리스트 페이지
Route::get('/', [NoticeController::class, 'index'])->name('admin.notice.index');

// 공지사항 작성 페이지
Route::get('/create', [NoticeController::class, 'create'])->name('admin.notice.create');

// 공지사항 수정 페이지
Route::get('/edit/{notice}', [NoticeController::class, 'edit'])->name('admin.notice.edit');

// API
Route::prefix('api')->group(function () {
    // 공지사항 작성
    Route::post('/v1', [NoticeController::class, 'store'])->name('admin.notice.store');

    // 공지사항 수정
    Route::put('/v1/{notice}', [NoticeController::class, 'update'])->name('admin.notice.update');

    // 공지사항 삭제
    Route::delete('/v1/{notice}', [NoticeController::class, 'delete'])->name('admin.notice.delete');
});
