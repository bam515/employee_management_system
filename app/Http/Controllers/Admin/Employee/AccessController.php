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

        $rows = User::where('status', '=', 1)
            ->latest()->paginate(10);

        return view('admin.employee.access.index', compact('rows'));
    }
}
