<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Notice;
use App\Models\NoticeComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class NoticeController extends Controller
{
    // 공지사항 인덱스 페이지
    public function index(Request $request) {
        $request->flash();

        $rows = Notice::from('notices as n')
            ->selectRaw('n.*, ifnull(count(nc.notice_comment_id, 0) as comment_count')
            ->leftJoin('notice_comments as nc', 'n.notice_no', '=', 'nc.notice_no');

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
                $rows->latest('n.notice_id');
            } else {
                $rows->oldest('n.notice_id');
            }
        } else {
            $rows->latest('n.notice_id');
        }

        if ($request->filled('post')) {
            $rows = $rows->paginate($request->post);
        } else {
            $rows = $rows->paginate(10);
        }

        return view('admin.notice.index', compact('rows'));
    }

    // 공지사항 작성 페이지
    public function create() {
        return view('admin.notice.register');
    }

    // 공지사항 작성
    public function store(Request $request) {
        DB::beginTransaction();

        try {
            Notice::create([
                'notice_title' => $request->title,
                'notice_content' => $request->contents,
                'created_at' => now(),
                'updated_at' => null
            ]);
            $msg = 'success';
            DB::commit();
        } catch (\Exception $exception) {
            $msg = $exception->getMessage();
            DB::rollBack();
        }
    }

    // 공지사항 수정 페이지
    public function edit(Notice $notice) {
        return view('admin.notice.edit');
    }

    // 공지사항 수정
    public function update(Notice $notice, Request $request) {
        DB::beginTransaction();

        try {
            $notice->update([
                'notice_title' => $request->title,
                'notice_content' => $request->contents,
                'updated_at' => now()
            ]);
            $msg = 'success';
            DB::commit();
        } catch (\Exception $exception) {
            $msg = $exception->getMessage();
            DB::rollBack();
        }
        return response()->json(['message' => $msg]);
    }

    // 공지사항 삭제
    public function delete(Notice $notice) {
        DB::beginTransaction();
        try {
            $notice->delete();
            $msg = 'success';
            DB::commit();
        } catch (\Exception $exception) {
            $msg = $exception->getMessage();
            DB::rollBack();
        }
        return response()->json(['message' => $msg]);
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
            $code = 200;
            $message = 'success';
            DB::commit();
        } catch (\Exception $exception) {
            $code = 500;
            $message = $exception->getMessage();
            DB::rollBack();
        }
        return response()->json([
            'code' => $code,
            'message' => $message
        ]);
    }

    // 공지사항 댓글 수정
    public function updateComment(NoticeComment $comment, Request $request) {
        DB::beginTransaction();

        try {
            $comment->update([
                'notice_comment' => $request->comment,
                'updated_at' => now(),
            ]);
            $code = 200;
            $message = 'success';
            DB::commit();
        } catch (\Exception $exception) {
            $code = 500;
            $message = $exception->getMessage();
            DB::rollBack();
        }
        return response()->json([
            'code' => $code,
            'message' => $message
        ]);
    }

    // 공지사항 댓글 삭제
    public function deleteComment(NoticeComment $comment) {
        DB::beginTransaction();

        try {
            $comment->delete();
            $code = 200;
            $message = 'success';
            DB::commit();
        } catch (\Exception $exception) {
            $code = 500;
            $message = $exception->getMessage();
            DB::rollBack();
        }
        return response()->json([
            'code' => $code,
            'message' => $message
        ]);
    }
}
