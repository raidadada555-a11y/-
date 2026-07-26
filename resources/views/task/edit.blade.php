<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>タスク編集</title>
</head>
<body>
    <h1>タスク編集</h1>

    @if ($errors->any())
        <div>
            @foreach ($errors->all() as $error)
                {{ $error }}<br>
            @endforeach
        </div>
    @endif

    <form action="{{ route('editSave', ['task_id' => $task->id]) }}" method="post">
        @csrf

        タスク名：<input name="name" value="{{ old('name', $task->name) }}"><br>
        期限：<input name="period" type="date" value="{{ old('period', $task->period) }}"><br>
        タスク詳細：<textarea name="detail">{{ old('detail', $task->detail) }}</textarea><br>

        重要度：
        <label>
            <input type="radio" name="priority" value="1" @if (old('priority', $task->priority) == 1) checked @endif>
            低い
        </label>
        <label>
            <input type="radio" name="priority" value="2" @if (old('priority', $task->priority) == 2) checked @endif>
            普通
        </label>
        <label>
            <input type="radio" name="priority" value="3" @if (old('priority', $task->priority) == 3) checked @endif>
            高い
        </label>
        <br>

        <button>更新する</button>
    </form>

    <a href="/task/list">タスク一覧に戻る</a>
</body>
</html>
