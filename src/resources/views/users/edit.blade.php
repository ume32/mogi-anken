@extends('layouts.app')

@section('title', 'プロフィール設定')

@section('css')
<link rel="stylesheet" href="{{ asset('css/users/edit.css') }}">
@endsection

@section('content')
<div class="profile-setup">
    <h1>プロフィール設定</h1>

    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="username">ユーザー名</label>
            <input type="text" name="username" id="username" 
                   value="{{ old('username', auth()->user()->username) }}" required>
        </div>

        <div class="form-group">
            <label for="postcode">郵便番号</label>
            <input type="text" name="postcode" id="postcode" 
                   value="{{ old('postcode', auth()->user()->postcode) }}" 
                   pattern="\d{3}-\d{4}" placeholder="例: 123-4567" required>
        </div>

        <div class="form-group">
            <label for="address">住所</label>
            <input type="text" name="address" id="address" 
                   value="{{ old('address', auth()->user()->address) }}" required>
        </div>

        <div class="form-group">
            <label for="phone">電話番号</label>
            <input type="text" name="phone" id="phone" 
                   value="{{ old('phone', auth()->user()->phone) }}" 
                   pattern="\d{10,11}" placeholder="例: 09012345678" required>
        </div>

        <div class="form-group">
            <label for="profile_image">プロフィール画像</label>
            <input type="file" name="profile_image" id="profile_image">

            <!-- プロフィール画像がある場合は表示 -->
            @if(auth()->user()->profile_image)
                <div class="profile-image-preview">
                    <img src="{{ asset('storage/' . auth()->user()->profile_image) }}" alt="プロフィール画像" width="100">
                </div>
            @endif
        </div>

        <button type="submit" class="btn btn-primary">更新する</button>
    </form>
</div>
@endsection
