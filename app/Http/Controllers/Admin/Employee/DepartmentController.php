<?php

namespace App\Http\Controllers\Admin\Employee;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    // 직원의 부서 변경
    public function update(User $user, Request $request) {
        $user->update([
            'department_id' => $request->department,
            'updated_at' => now(),
        ]);
    }
}
