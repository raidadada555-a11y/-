@extends("admin.layout")

@section("contents")
    <div class="container mt-4">
        <h1>管理画面 ログイン</h1>
        
        {{-- エラー表示部分 --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    {{ $error }}<br>
                @endforeach
            </div>
        @endif

        <form action="/admin/login" method="post">
            @csrf
            <div class="mb-3">
                <label class="form-label">ログインID：</label>
                <input type="text" name="login_id" class="form-control" value="{{ old('login_id') }}">
            </div>
            <div class="mb-3">
                <label class="form-label">パスワード：</label>
                <input type="password" name="password" class="form-control">
            </div>
            <button class="btn btn-primary mb-3">ログインする</button>
        </form>
    </div>
@endsection
