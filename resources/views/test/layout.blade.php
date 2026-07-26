<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>管理画面</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    @auth('admin')
        <div class="container mt-2">
            <menu label="リンク">
                管理画面機能 1<br>
                管理画面機能 2<br>
                管理画面機能 3<br>
                管理画面機能 4<br>
                <a href="/admin/logout">ログアウト</a><br>
            </menu>
        </div>
    @endauth

    <div class="container mt-4">
        @yield('contents')
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
