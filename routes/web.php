<?php

use App\Http\Controllers\User\LoginController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('user.index');
})->name('home');

// 로그인 페이지
Route::get('/login', [LoginController::class, 'loginForm'])->name('login-form');
// 로그인
Route::post('/login', [LoginController::class, 'login'])->name('login');
// 로그아웃
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
