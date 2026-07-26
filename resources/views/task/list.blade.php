<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>タスク一覧</title>
</head>
<body>
    <h1>タスク管理 アプリケーション</h1>

    <!-- 1. タスク登録フォーム -->
    <h2>タスクの登録</h2>
    <form action="{{ route('task.register') }}" method="POST">
        @csrf
        <div>タスク名: <input type="text" name="name" required></div>
        <div>期限: <input type="date" name="period" required></div>
        <div>タスク詳細: <textarea name="detail"></textarea></div>
        <div>重要度: 
            <input type="radio" name="priority" value="1">低い
            <input type="radio" name="priority" value="2" checked>普通
            <input type="radio" name="priority" value="3">高い
        </div>
        <button type="submit">タスクを登録する</button>
    </form>

    <hr>

    <!-- 2. タスク一覧テーブル -->
    <h2>タスクの一覧</h2>
    <a href="{{ route('completed_tasks.list') }}">完了タスク一覧</a>
    
    <table border="1" style="margin-top: 10px;">
        <tr>
            <th>タスク名</th>
            <th>期限</th>
            <th>重要度</th>
            <th>詳細</th>
            <th>編集</th>
            <th>操作</th>
        </tr>
        @foreach ($list as $task)
        <tr>
            <td>{{ $task->name }}</td>
            <td>{{ $task->period }}</td>
            <td>{{ $task->priority }}</td>
            <td>
                <a href="{{ route('detail', ['task_id' => $task->id]) }}">詳細閲覧</a>
            </td>
            <td>
                <a href="{{ route('edit', ['task_id' => $task->id]) }}">編集</a>
            </td>
            <td>
                <form action="{{ route('task.complete', ['task_id' => $task->id]) }}" method="post" style="display:inline;">
                    @csrf
                    <button type="submit">完了</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
    
    <!-- ページネーション表示 -->
    <div style="margin-top: 10px;">
        <p>現在 {{ $list->currentPage() }} ページ目</p>
        
        <div>
            {{-- 最初のページへ --}}
            <a href="{{ $list->url(1) }}">最初のページ</a> / 
            
            {{-- 前のページへ --}}
            @if ($list->onFirstPage())
                <span>前に戻る</span>
            @else
                <a href="{{ $list->previousPageUrl() }}">前に戻る</a>
            @endif / 
            
            {{-- 次のページへ --}}
            @if ($list->hasMorePages())
                <a href="{{ $list->nextPageUrl() }}">次に進む</a>
            @else
                <span>次に進む</span>
            @endif
        </div>
    </div>

    <hr>
    <a href="/logout">ログアウト</a>
</body>
</html>