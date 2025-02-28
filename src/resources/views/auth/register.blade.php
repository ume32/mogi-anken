@extends('layouts.app')

@section('title', '会員登録')

@section('css')
<link rel="stylesheet" href="{{ asset('css/auth/register.css') }}">
@endsection

@section('content')
<div class="register-container">
    <h1 class="register-title">会員登録</h1>
    @if ($errors->any())
        <div class="error-messages">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form class="form" action="{{ route('auth.register') }}" method="post">
        @csrf
        <div class="form-group">
            <label for="name">ユーザー名</label>
            <input type="text" name="name" id="name" class="form-input" required>
        </div>
        <div class="form-group">
            <label for="email">メールアドレス</label>
            <input type="email" name="email" id="email" class="form-input" required>
        </div>
        <div class="form-group">
            <label for="password">パスワード (8文字以上)</label>
            <input type="password" name="password" id="password" class="form-input" minlength="8" required>
        </div>
        <div class="form-group">
            <label for="password_confirmation">確認用パスワード</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="form-input" minlength="8" required>
        </div>
        <button type="submit" class="register-button">登録する</button>
    </form>
    <p class="register-link">
        <a href="{{ route('auth.login') }}">ログインはこちら</a>
    </p>
</div>
@endsection
