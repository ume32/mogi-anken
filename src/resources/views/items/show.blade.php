@extends('layouts.app')

@section('title', $item->name . ' | 商品詳細')

@section('css')
<link rel="stylesheet" href="{{ asset('css/items/show.css') }}">
@endsection

@section('content')
<div class="item-detail-container">
    <div class="item-detail">
        <!-- 商品画像 -->
        <img src="{{ asset($item->image) }}" alt="{{ $item->name }}">
        <h3>{{ $item->name }}</h3>
    </div>

    <!-- 商品情報 -->
    <div class="item-info">
        <h1>{{ $item->name }}</h1>
        <p class="price">¥{{ number_format($item->price) }} (税込)</p>
        
        <!-- いいねボタン（星マーク） -->
        @auth
            @php
                $favorites = Auth::user()->favoriteItemIds();
            @endphp
            <div class="like-section">
                <span class="like-button" data-item-id="{{ $item->id }}">
                    {{ in_array($item->id, $favorites) ? '⭐' : '☆' }}
                </span>
            </div>
        @else
            <div class="like-section">
                <span class="like-button disabled">☆</span>
            </div>
        @endauth

        <a href="{{ route('purchase.show', $item->id) }}" class="buy-button">購入手続きへ</a>

        <h2>商品説明</h2>
        <p>{{ $item->description }}</p>

        <h3>商品の情報</h3>
        <ul class="item-details">
            <li>カテゴリー: {{ $item->category }}</li>
            <li>商品の状態: {{ $item->condition ?? '未設定' }}</li>
        </ul>

        <!-- コメント欄 -->
        <h3>コメント ({{ $item->comments->count() }})</h3>
        <div class="comments">
            @foreach($item->comments as $comment)
                <div class="comment">
                    <strong>{{ $comment->user->name }}</strong>
                    <p>{{ $comment->content }}</p>
                </div>
            @endforeach
        </div>

        <!-- コメント入力フォーム -->
        <form action="{{ route('comments.store', $item->id) }}" method="POST">
            @csrf
            <textarea name="content" required placeholder="商品のコメントを入力"></textarea>
            <button type="submit" class="comment-button">コメントを投稿する</button>
        </form>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const likeButton = document.querySelector('.like-button');

    if (likeButton && !likeButton.classList.contains('disabled')) {
        likeButton.addEventListener('click', function() {
            const itemId = this.dataset.itemId;

            fetch(`/favorite/${itemId}`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({})
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'added') {
                    likeButton.innerHTML = '⭐';
                } else {
                    likeButton.innerHTML = '☆';
                }
            })
            .catch(error => console.error('Error:', error));
        });
    }
});
</script>
@endsection
