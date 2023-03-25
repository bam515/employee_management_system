<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\NoticeController;

// 공지사항 리스트 페이지
Route::get('/', [NoticeController::class, 'index'])->name('user.notice.index');

// 공지사항 상세보기 페이지
Route::get('/{notice}', [NoticeController::class, 'show'])->name('user.notice.show');

// 공지사항 첨부파일 다운로드
Route::get('/file/{notice}', [NoticeController::class, 'downloadFile'])->name('user.notice.file');

// 공지사항 API
Route::prefix('api')->group(function () {
    // 공지사항 댓글 다운로드
    Route::post('/v1/comment', [NoticeController::class, 'storeComment'])->name('user.notice.comment.store');

    // 공지사항 댓글 수정
    Route::put('/v1/comment/{comment}', [NoticeController::class, 'updateComment'])->name('user.notice.comment.update');
});
