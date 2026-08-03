<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\CompletedTaskController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController; 
use App\Http\Controllers\Admin\AuthController as AdminAuthController;
use App\Http\Controllers\Admin\HomeController as AdminHomeController;

// トップページ（ログイン判定）
Route::get('/', function () {
    if (\Illuminate\Support\Facades\Auth::check()) {
        return redirect('/task/list');
    }
    return view('welcome');
})->name('front.index');

// 通常ログイン用
Route::post('/login', [LoginController::class, 'login'])->name('login');

// 会員登録関連
Route::get('/user/register', [UserController::class, 'index'])->name('front.user.register');
Route::post('/user/register', [UserController::class, 'register'])->name('front.user.register.post');

// タスク管理関連（ログイン必須）
Route::middleware(['auth'])->group(function () {
    Route::get('/task/list', [TaskController::class, 'list'])->name('task.list');
    Route::post('/task/register', [TaskController::class, 'register'])->name('task.register');
    Route::get('/task/edit/{task_id}', [TaskController::class, 'edit'])->name('edit');
    Route::post('/task/editSave/{task_id}', [TaskController::class, 'editSave'])->name('editSave');
    Route::get('/task/detail/{task_id}', [TaskController::class, 'detail'])->name('detail');
    
    // 完了タスク一覧・完了処理
    Route::get('/completed_tasks/list', [CompletedTaskController::class, 'list'])->name('completed_tasks.list');
    Route::post('/task/complete/{task_id}', [TaskController::class, 'complete'])->name('task.complete');

    // ログアウト
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
});

// 管理画面
Route::get('/admin', [AdminAuthController::class, 'index'])->name('admin.index');
Route::post('/admin/login', [AdminAuthController::class, 'login'])->name('admin.login');

Route::prefix('/admin')->middleware(['auth:admin'])->group(function () {
    Route::get('/top', [AdminHomeController::class, 'top'])->name('admin.top');
    Route::get('/logout', [AdminAuthController::class, 'logout']);
});