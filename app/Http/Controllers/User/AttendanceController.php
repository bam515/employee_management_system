<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\IPAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AttendanceController extends Controller
{
    // 출근 기록 저장
    public function registerAttendance(Request $request) {
        // IP 주소 확인
        $check = $this->checkIPAddress($request->ip());

        DB::beginTransaction();

        try {
            if ($check) {
                Attendance::create([
                    'user_id' => Auth::guard('web')->user()->user_id,
                    'start_date' => now()
                ]);
                $msg = 'success';
                $code = 200;
            } else {
                $msg = '허용된 IP주소가 아닙니다.';
                $code = 400;
            }
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

    // 퇴근 기록하기
    public function registerLeave(Request $request) {
        // IP 주소 확인
        $check = $this->checkIPAddress($request->ip());

        DB::beginTransaction();

        try {
            if ($check) {
                $todayAttendance = Attendance::where('user_id', Auth::guard('web')->user()->user_id)
                    ->whereDate('start_date', date('Y-m-d'))->first();
                if ($todayAttendance) {
                    Attendance::where('user_id', Auth::guard('web')->user()->user_id)
                        ->whereDate('start_date', date('Y-m-d'))->update([
                            'end_date' => now()
                        ]);
                    $msg = 'success';
                    $code = 200;
                } else {
                    $code = 400;
                    $msg = '오늘 출근한 기록이 없습니다.';
                }
            } else {
                $msg = '허용된 IP주소가 아닙니다.';
                $code = 400;
            }
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

    // IP 주소 확인
    public function checkIPAddress(string $ip) {
        $check = IPAddress::where('ip', $ip)->first();

        if ($check) {
            return true;
        }
        return false;
    }
}
