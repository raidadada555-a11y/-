@extends('layouts.app')

@section('content')
<div class="container">
    <h1>完了タスク一覧</h1>

    <div class="mb-3">
        <a href="/task/list" class="btn btn-secondary">タスク一覧に戻る</a>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>タスク名</th>
                <th>期限</th>
                <th>重要度</th>
                <th>タスク詳細</th>
                <th>タスク終了日</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($completedTasks as $task)
                <tr>
                    <td>{{ $task->name }}</td>
                    <td>{{ $task->period }}</td>
                    <td>{{ $task->getPriorityString() }}</td>
                    <td>{{ $task->detail }}</td>
                    <td>{{ $task->created_at }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $completedTasks->links() }}
</div>
@endsection
