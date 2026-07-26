<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\TaskRegisterPostRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\Task as TaskModel;
use App\Models\CompletedTask; // 必須：完了タスクモデルの読み込み

class TaskController extends Controller
{
    /**
     * タスク一覧ページ を表示する
     * 
     * @return \Illuminate\View\View
     */
    public function list()
    {
        // 1ページあたりの表示アイテム数を設定
        $per_page = 2;
        
        // ログインユーザーのタスク一覧を取得（並び替えとペジネーションを適用）
        $list = TaskModel::where('user_id', Auth::id())
                         ->orderBy('priority', 'DESC')
                         ->orderBy('period')
                         ->orderBy('created_at')
                         ->paginate($per_page);
        
        return view('task.list', ['list' => $list]);
    }
    
    /**
     * タスクの新規登録
     */
    public function register(TaskRegisterPostRequest $request)
    {
        // validate済みのデータの取得
        $datum = $request->validated();

        // user_id の追加
        $datum['user_id'] = Auth::id();

        // テーブルへのINSERT
        try {
            $r = TaskModel::create($datum);
        } catch(\Throwable $e) {
            echo $e->getMessage();
            exit;
        }

        // タスク登録成功
        $request->session()->flash('front.task_register_success', true);

        // リダイレクト
        return redirect('/task/list');
    }
    
    /**
     * タスクの詳細閲覧
     */
    public function detail($task_id)
    {
        return $this->singleTaskRender($task_id, 'task.detail');
    }
    
    /**
     * タスクの編集画面表示
     */
    public function edit($task_id)
    {
        return $this->singleTaskRender($task_id, 'task.edit');
    }
    
    /**
     * タスクの更新処理
     */
    public function editSave(TaskRegisterPostRequest $request, $task_id)
    {
        // formからの情報を取得する(validate済みのデータの取得)
        $datum = $request->validated();

        // task_idのレコードを取得する
        $task = $this->getTaskModel($task_id);
        if ($task === null) {
            return redirect('/task/list');
        }

        // レコードの内容をUPDATEする
        $task->name = $datum['name'];
        $task->period = $datum['period'];
        $task->detail = $datum['detail'];
        $task->priority = $datum['priority'];

        // レコードを更新
        $task->save();

        // タスク編集成功
        $request->session()->flash('front.task_edit_success', true);
        
        // 詳細閲覧画面にリダイレクトする
        return redirect(route('detail', ['task_id' => $task->id]));
    } 

    /**
     * タスクの完了処理
     */
    public function complete($task_id)
    {
        // 1. タスクの取得（getTaskModelを使って本人確認も同時に行う）
        $task = $this->getTaskModel($task_id);
        if ($task === null) {
            return redirect('/task/list');
        }

        // 2. 完了タスクテーブル(completed_tasks)へ保存
        // データベースのカラム名に合わせた値を代入
        CompletedTask::create([
            'user_id'     => $task->user_id,
            'name'        => $task->name,
            'period'      => $task->period,
            'detail'      => $task->detail,
            'priority'    => $task->priority,
        ]);

        // 3. 元のタスクを削除
        $task->delete();

        // 4. 一覧へリダイレクト
        return redirect('/task/list')->with('message', 'タスクを完了しました');
    }
    
    /**
     * 「単一のタスク」Modelの取得
     */
    protected function getTaskModel($task_id)
    {
        // task_idのレコードを取得する
        $task = TaskModel::find($task_id);
        if ($task === null) {
            return null;
        }
        // 本人以外のタスクならNGとする
        if ($task->user_id !== Auth::id()) {
            return null;
        }
        
        return $task;
    }

    /**
     * 「単一のタスク」の表示
     */
    protected function singleTaskRender($task_id, $template_name)
    {
        // task_idのレコードを取得する
        $task = $this->getTaskModel($task_id);
        if ($task === null) {
            return redirect('/task/list');
        }

        // テンプレートに「取得したレコード」の情報を渡す
        return view($template_name, ['task' => $task]);
    }
}