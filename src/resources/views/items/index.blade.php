@extends('layouts.app')

@section('title', '商品一覧')

@section('css')
<link rel="stylesheet" href="{{ asset('css/items/index.css') }}">
@endsection

@section('content')
<div class="item-list-container">
    <h1>商品一覧</h1>

    <!-- 検索結果の表示 -->
    @if(request()->has('search'))
        <p class="search-result">「{{ request('search') }}」の検索結果: {{ $items->count() }}件</p>
    @endif

    <!-- タブメニュー -->
    <div class="tab-menu">
        <button class="tab-button active" onclick="showTab('recommend')">おすすめ</button>
        <button class="tab-button" onclick="showTab('mylist')">マイリスト</button>
    </div>

    <!-- 商品一覧: おすすめ -->
    <div id="recommend" class="tab-content active">
        <div class="item-grid">
            @foreach ($items as $item)
                <div class="item-card">
                    <img src="{{ asset($item->image) }}" alt="{{ $item->name }}">
                    <h3>{{ $item->name }}</h3>
                    <p>価格: ¥{{ number_format($item->price) }}</p>

                    <a href="{{ route('items.show', ['item_id' => $item->id]) }}" class="detail-button">
                        詳細を見る
                    </a>
                </div>
            @endforeach
        </div>
    </div>

    <!-- 商品一覧: マイリスト（ログインしている場合のみ表示） -->
    @auth
        @if ($myItems->isNotEmpty())
        <div id="mylist" class="tab-content">
            <div class="item-grid">
                @foreach ($myItems as $item)
                    <div class="item-card">
                        <img src="{{ asset($item->image) }}" alt="{{ $item->name }}">
                        <h3>{{ $item->name }}</h3>
                        <p>価格: ¥{{ number_format($item->price) }}</p>

                        <a href="{{ route('items.show', ['item_id' => $item->id]) }}" class="detail-button">
                            詳細を見る
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
        @else
        <div id="mylist" class="tab-content">
            <p>マイリストに商品がありません。</p>
        </div>
        @endif
    @endauth
</div>

<!-- JavaScript for Tab Switch -->
<script src="{{ asset('js/tabs.js') }}"></script>

<script>
document.addEventListener("DOMContentLoaded", function() {
    function showTab(tabName) {
        const tabs = document.querySelectorAll('.tab-content');
        tabs.forEach(tab => tab.style.display = 'none');

        const buttons = document.querySelectorAll('.tab-button');
        buttons.forEach(button => button.classList.remove('active'));

        document.getElementById(tabName).style.display = 'block';
        document.querySelector(`[onclick="showTab('${tabName}')"]`).classList.add('active');
    }

    showTab('recommend');
});
</script>
@endsection
