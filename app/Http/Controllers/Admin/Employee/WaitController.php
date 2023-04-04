<?php

namespace App\Http\Controllers\Admin\Employee;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class WaitController extends Controller
{
    // 직원 관리 > 대기 직원 - index
    public function index(Request $request) {
        $request->flash();

        $rows = User::where('status', '=', 0)
            ->latest()->paginate(10);

        return view('admin.employee.wait.index', compact('rows'));
    }
}
