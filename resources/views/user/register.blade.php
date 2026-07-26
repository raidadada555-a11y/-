<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>会員登録</title>
</head>
<body>
    <h1>会員登録</h1>

    @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- 送信先URLをブレないように固定しました -->
    <form action="/user/register" method="post">
        @csrf
        名前：<input type="text" name="name" value="{{ old('name') }}"><br><br>
        メールアドレス：<input type="email" name="email" value="{{ old('email') }}"><br><br>
        パスワード：<input type="password" name="password"><br><br>
        <button type="submit">登録する</button>
    </form>
    
    <br>
    <a href="/">トップページに戻る</a>
</body>
</html>