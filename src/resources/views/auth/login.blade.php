@extends('layouts.app')

@section('title', 'ログイン')

@section('css')
<link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection

@section('content')
<div class="login-container">
    <h1 class="login-title">ログイン</h1>
    <form method="POST" action="{{ route('auth.login') }}" class="login-form">
        @csrf
        <div class="form-group">
            <label for="email">ユーザー名 / メールアドレス</label>
            <input type="text" name="email" id="email" class="form-input" required>
        </div>
        <div class="form-group">
            <label for="password">パスワード</label>
            <input type="password" name="password" id="password" class="form-input" required>
        </div>
        <button type="submit" class="login-button">ログインする</button>
    </form>
    <p class="login-link">
        <a href="{{ route('auth.register') }}">会員登録はこちら</a>
    </p>
</div>
@endsection
