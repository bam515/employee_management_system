<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Notice;
use App\Models\NoticeComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class NoticeController extends Controller
{
    // 공지사항 리스트 페이지
    public function index(Request $request) {
        $request->flash();

        $rows = Notice::select('*');

        if ($request->filled('keyword')) {
            $keyword = '%' . $request->keyword . '%';
            $category = $request->category;
            if ($category !== null) {
                if ($category === 'all') {
                    $rows->where(function ($query) use ($keyword) {
                        $query->where('notice_title', 'like', $keyword)
                            ->orWhere('notice_content', 'like', $keyword);
                    });
                } else {
                    $rows->where($category, 'like', $keyword);
                }
            }
        }

        if ($request->filled('order')) {
            $order = $request->order;
            if ($order === 'desc') {
                $rows->latest();
            } else {
                $rows->oldest();
            }
        } else {
            $rows->latest();
        }

        if ($request->filled('post')) {
            $rows = $rows->paginate($request->post);
        } else {
            $rows = $rows->paginate(10);
        }

        return view('notice.index', compact('rows'));
    }

    // 공지사항 첨부파일 다운로드
    public function downloadFile(Notice $notice) {

    }

    // 공지사항 댓글 작성
    public function storeComment(Notice $notice, Request $request) {
        DB::beginTransaction();

        try {
            NoticeComment::create([
                'notice_id' => $notice->notice_id,
                'user_id' => Auth::guard('web')->user()->user_id,
                'notice_comment' => $request->comment,
                'created_at' => now(),
                'updated_at' => null
            ]);
            $message = 'success';
            DB::commit();
        } catch (\Exception $exception) {
            $message = $exception->getMessage();
            DB::rollBack();
        }
        return response()->json(['message' => $message]);
    }
}
