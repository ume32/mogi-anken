<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'COACHTECH')</title>
    
    <!-- CSS 読み込み -->
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    
    @yield('css') <!-- 各ページ固有のCSS -->
</head>
<body>

    <header class="auth-header">
        <div class="logo-container">
            <a href="{{ route('items.index') }}">
                <img src="{{ asset('images/logo.svg') }}" alt="COACHTECH" class="logo">
            </a>
        </div>

        <!-- 🔍 検索ボックス -->
        <form action="{{ route('items.index') }}" method="GET" class="search-form">
            <input type="text" name="search" placeholder="何をお探しですか？" class="search-input" value="{{ request('search') }}">
            <button type="submit" class="search-button">🔍</button>
        </form>
        
        <nav class="header-nav">
            <ul>
                @if (Auth::check())
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('mypage.index') }}">マイページ</a>
                    </li>
                    <li class="nav-item">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="nav-button">ログアウト</button>
                        </form>
                    </li>
                    <li class="nav-item">
                        <a class="sell-button" href="{{ route('items.create') }}">出品</a>
                    </li>
                @else
                    <li class="nav-item"><a class="nav-link" href="{{ route('auth.login') }}">ログイン</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('auth.register') }}">会員登録</a></li>
                @endif
            </ul>
        </nav>
    </header>

    <main>
        @yield('content') <!-- 各ページのメインコンテンツ -->
    </main>

</body>
</html>
