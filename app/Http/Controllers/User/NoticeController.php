<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Notice;
use App\Models\NoticeComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

/**
 * @OA\Tag(
 *     name="사용자 공지사항",
 *     description="사용자 공지사항 관련 API"
 * )
 */
class NoticeController extends Controller
{
    // 공지사항 리스트 페이지
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

        return view('user.notice.index', compact('rows'));
    }

    // 공지사항 상세보기 페이지
    public function show(Notice $notice) {
        return view('user.notice.show', compact('notice'));
    }

    // 공지사항 첨부파일 다운로드
    public function downloadFile(Notice $notice) {

    }

    /**
     * @OA\Post(
     *     path="/notice/api/v1/comment/{notice}",
     *     tags={"사용자 공지사항"},
     *     @OA\Response(
     *     response=200,
     *     description="Success"
     *     ),
     *     @OA\Response(
     *     response=500,
     *     description="Fail",
     *     )
     * ),
     */
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
            $code = 200;
            DB::commit();
        } catch (\Exception $exception) {
            $message = $exception->getMessage();
            $code = 500;
            DB::rollBack();
        }
        return response()->json([
            'code' => $code,
            'message' => $message,
        ]);
    }

    // 공지사항 댓글 수정
    public function updateComment(NoticeComment $comment, Request $request) {
        DB::beginTransaction();
        try {
            $comment->update([
                'notice_comment' => $request->comment,
                'updated_at' => now()
            ]);
            $msg = 'success';
            $code = 200;
            DB::commit();
        } catch (\Exception $exception) {
            $msg = $exception->getMessage();
            $code = 500;
            DB::rollBack();
        }
        return response()->json([
            'code' => $code,
            'message' => $msg
        ]);
    }
}
