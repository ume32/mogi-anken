@extends('layouts.app')

@section('title', 'マイページ')

@section('css')
<link rel="stylesheet" href="{{ asset('css/users/profile.css') }}">
@endsection

@section('content')
<div class="profile-container">
    <h1>マイページ</h1>
    <div class="profile-info">
        <h2>{{ $user->name }}</h2>
        <p>Email: {{ $user->email }}</p>
    </div>

    <h3>購入した商品</h3>
    <ul>
        @foreach($purchasedItems as $purchase)
            <li>{{ $purchase->item->name }} - ¥{{ number_format($purchase->item->price) }}</li>
        @endforeach
    </ul>

    <h3>出品した商品</h3>
    <ul>
        @foreach($soldItems as $item)
            <li>{{ $item->name }} - ¥{{ number_format($item->price) }}</li>
        @endforeach
    </ul>

    <a href="{{ route('profile.edit') }}" class="edit-button">プロフィール編集</a>
</div>
@endsection
