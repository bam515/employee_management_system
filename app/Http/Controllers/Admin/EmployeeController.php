<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmployeeController extends Controller
{
    // 직원 관리 - index
    public function index(Request $request) {
        $request->flash();

        $rows = User::latest()->paginate(10);

        return view('admin.employee.index', compact('rows'));
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
}
