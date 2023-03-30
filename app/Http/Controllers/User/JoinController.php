<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class JoinController extends Controller
{
    // 회원가입 폼
    public function create() {
        return view('user.join.create');
    }

    // 회원가입
    public function store(Request $request) {
        DB::beginTransaction();

        try {
            $request->validate([
                'login_id' => 'string|required',
                'name' => 'string|required',
                'birth' => 'date|required',
                'phone' => 'string|required',
                'address' => 'string|required',
                'password' => 'string|required'
            ]);

            User::create([
                'login_id' => $request['login_id'],
                'name' => $request['name'],
                'birth' => $request['birth'],
                'phone' => $request['phone'],
                'address' => $request['address'],
                'password' => Hash::make($request['password']),
                'created_at' => now(),
                'updated_at' => null,
                'user_type' => 0
            ]);
            $code = 200;
            $msg = 'success';
            DB::commit();
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
}
