<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    // 로그인 폼
    public function loginForm() {
        return view('admin.login');
    }

    // 로그인
    public function login(Request $request) {
        $admin = Admin::where('login_id', '=', $request->login_id)->first();

        if ($admin) {
            if (Hash::check($request->password, $admin->password)) {
                Auth::guard('admin')->login($admin);
                return redirect()->intended('/');
            } else {
                return back()->withErrors(['password' => '비밀번호가 틀립니다.']);
            }
        }
        return back()->withErrors(['login_id' => '일치하는 계정 정보가 없습니다.']);
    }

    // 로그아웃
    public function logout() {
        Auth::guard('admin')->logout();
        return redirect('/');
    }
}
