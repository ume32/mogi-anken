@extends('layouts.app')

@section('title', '購入確認')

@section('css')
<link rel="stylesheet" href="{{ asset('css/purchase/confirm.css') }}">
@endsection

@section('content')
<div class="confirm-container">
    <h1>購入確認</h1>

    <div class="item-info">
        <img src="{{ asset($item->image) }}" alt="{{ $item->name }}">
        <h2>{{ $item->name }}</h2>
        <p>価格: ¥{{ number_format($item->price) }}</p>
    </div>

    <div class="address-section">
        <h3>送付先住所</h3>
        <p>郵便番号: {{ $address->postal_code ?? '未登録' }}</p>
        <p>住所: {{ $address->address_line1 ?? '未登録' }}</p>
        <p>建物名: {{ $address->address_line2 ?? '' }}</p>

        <a href="{{ route('address.edit', $item->id) }}" class="address-button">住所を変更する</a>
    </div>

    <form method="POST" action="{{ route('purchase.store', $item->id) }}">
        @csrf
        <label for="payment_method">支払い方法</label>
        <select name="payment_method" id="payment_method" required>
            <option value="credit">クレジットカード</option>
            <option value="convenience">コンビニ支払い</option>
        </select>

        <button type="submit" class="confirm-button">購入を確定する</button>
    </form>
</div>
@endsection
