<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Default Title')</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
	<link rel="stylesheet" href="{{ asset('css/app.css') }}">
	@yield('css')
</head>
<body>
    <header class="auth-header">
        <div class="logo-container">
            <img src="{{ asset('images/logo.svg') }}" alt="COACHTECH" class="logo">
        </div>
        <nav>
            <ul class="header-nav">
                @if (Auth::check())
                <li class="header-nav__item">
                    <a class="header-nav__link" href="/mypage">マイページ</a>
                </li>
                <li class="header-nav__item">
                    <form class="form" action="/logout" method="post">
                    @csrf>
                        <button class="header-nav__button">ログアウト</button>
                    </form>
                </li>
                @endif
            </ul>
        </nav>
    </header>
    <main>
        @yield('content')
    </main>
</body>
</html>