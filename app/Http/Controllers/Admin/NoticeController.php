<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Notice;
use Illuminate\Http\Request;

class NoticeController extends Controller
{
    // 공지사항 인덱스 페이지
    public function index(Request $request) {
        return view('admin.notice.index');
    }

    // 공지사항 작성 페이지
    public function create() {
        return view('admin.notice.register');
    }

    // 공지사항 작성
    public function store(Request $request) {
        Notice::create([
            'notice_title' => $request->title,
            'notice_content' => $request->contents,
            'created_at' => now(),
            'updated_at' => null
        ]);
    }

    // 공지사항 수정 페이지
    public function edit(Notice $notice) {
        return view('admin.notice.edit');
    }

    // 공지사항 수정
    public function update(Notice $notice, Request $request) {
        $notice->update([
            'notice_title' => $request->title,
            'notice_content' => $request->contents,
            'updated_at' => now()
        ]);
    }

    // 공지사항 삭제
    public function delete(Notice $notice) {
        $notice->delete();
        
    }
}
