<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>タスク詳細</title>
</head>
<body>
    <h1>タスク詳細</h1>

    <p>タスク名：{{ $task->name }}</p>
    <p>期限：{{ $task->period }}</p>
    <p>タスク詳細：{{ $task->detail }}</p>
    <p>重要度：{{ $task->priority }}</p>

    <a href="/task/list">タスク一覧に戻る</a>
</body>
</html>
