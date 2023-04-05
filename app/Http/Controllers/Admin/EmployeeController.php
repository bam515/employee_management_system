<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\Admin\EmployeeExport;

class EmployeeController extends Controller
{
    // 회원가입 승인
    public function accessSignup(User $user, Request $request) {
        DB::beginTransaction();
        try {
            $count = User::count();
            $emp_no = date('Ymd') . $request->department . (++$count);
            $user->update([
                'join_date' => now(),
                'status' => 1,
                'department_id' => $request->department,
                'emp_no' => $emp_no
            ]);
            $code = 200;
            $msg = 'success';
        } catch (\Exception $exception) {
            $code = 500;
            $msg = $exception->getMessage();
            DB::rollBack();
        }
        return response()->json([
            'code' => $code,
            'message' => $msg
        ]);
    }

    // 회원가입 거절
    public function rejectSignup(User $user) {
        DB::beginTransaction();
        try {
            $user->update([
                'status' => 2
            ]);
            $code = 200;
            $msg = 'success';
        } catch (\Exception $exception) {
            $code = 500;
            $msg = $exception->getMessage();
            DB::rollBack();
        }
        return response()->json([
            'code' => $code,
            'message' => $msg
        ]);
    }

    // 직원 삭제
    public function delete(Request $request) {
        DB::beginTransaction();

        try {
            $employeeList = $request->employeeList;
            User::whereIn('user_id', $employeeList)->delete();
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

    // 직원 부서 변경
    public function updateDepartment(User $user, Request $request) {
        DB::beginTransaction();

        try {
            $user->update([
                'department_id' => $request->department,
                'updated_at' => now()
            ]);
            $code = 200;
            $msg = 'success';
        } catch (\Exception $exception) {
            $code = 500;
            $msg = $exception->getMessage();
            DB::rollBack();
        }
        return response()->json([
            'code' => $code,
            'message' => $msg
        ]);
    }

    // 엑셀 다운로드
    public function excel(Request $request) {
        return Excel::download(new EmployeeExport($request), '직원관리_' . date('Y-m-d') . '.xlsx');
    }
}
