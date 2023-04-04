<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    // 부서 index
    public function index(Request $request) {
        $request->flash();

        $rows = Department::latest()->paginate(10);

        return view('admin.department.index', compact('rows'));
    }

    // 부서 생성 폼
    public function create() {
        return view('admin.department.create');
    }

    // 부서 생성
    public function store(Request $request) {
        $request->validate([
            'department' => 'required'
        ]);
        Department::create([
            'department' => $request['department'],
            'created_at' => now(),
            'updated_at' => null
        ]);
        return redirect()->route('admin.department.index')->with(['store' => '저장되었습니다.']);
    }

    // 부서 수정 폼
    public function edit(Department $department) {
        return view('admin.department.edit', compact('department'));
    }

    // 부서 수정
    public function update(Department $department, Request $request) {
        $request->validate([
            'department' => 'required'
        ]);
        $department->update([
            'department' => $request['department'],
            'updated_at' => now()
        ]);
        return redirect()->route('admin.department.index')->with(['update' => '수정되었습니다.']);
    }

    // 부서 삭제
    public function delete(Department $department) {
        $department->delete();
        return redirect()->route('admin.department.index')->with(['delete' => '삭제되었습니다.']);
    }
}
