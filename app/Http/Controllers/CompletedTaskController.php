<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\CompletedTask; // モデルを使用

class CompletedTaskController extends Controller
{
    /**
     * 完了タスク一覧を表示する
     */
    public function list()
    {
        // 1ページあたりの表示件数
        $per_page = 2;

        // モデルを使用して取得（ページネーション適用）
        $completedTasks = CompletedTask::where('user_id', Auth::id())
                            ->orderBy('created_at', 'DESC')
                            ->paginate($per_page);

        // 変数名 $completedTasks でBladeへ渡す
        return view('task.completed_list', compact('completedTasks'));
    }
}