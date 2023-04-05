<?php

namespace App\Http\Controllers\Admin\Employee;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AccessController extends Controller
{
    // 직원 관리 > 현재 직원 - index
    public function index(Request $request) {
        $request->flash();

        $rows = User::where('status', '=', 1);

        if ($request->keyword !== null) {
            $category = $request->category;
            $keyword = '%' . $request->keyword . '%';
            if ($category !== 'all') {
                $rows->where($category, 'like', $keyword);
            } else {
                $rows->where(function ($query) use ($keyword) {
                    $query->where('name', 'like', $keyword)
                        ->where('emp_no', 'like', $keyword);
                });
            }
        }

        if ($request->department !== null) {
            $rows->where('department_id', '=', $request->department);
        }

        if ($request->order !== null) {
            if ($request->order === 'desc') {
                $rows->latest();
            } else {
                $rows->latest();
            }
        } else {
            $rows->latest();
        }

        if ($request->post !== null) {
            $rows = $rows->paginate($request->post);
        } else {
            $rows = $rows->paginate(10);
        }

        return view('admin.employee.access.index', compact('rows'));
    }
}
