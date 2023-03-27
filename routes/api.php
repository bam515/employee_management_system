<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\AttendanceController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// 출근 기록하기
Route::post('/api/v1/attendance', [AttendanceController::class, 'registerAttendance'])->name('attendance-register');

// 퇴근 기록하기
Route::put('/api/v1/leave', [AttendanceController::class, 'registerLeave'])->name('leave-register');
