@extends('layouts.app')

@section('title', '住所変更')

@section('css')
<link rel="stylesheet" href="{{ asset('css/purchase/address.css') }}">
@endsection

@section('content')
<div class="address-container">
    <h1>送付先住所の変更</h1>

    @if(isset($item))
        <div class="item-info">
            <h2>{{ $item->name }}</h2>
            <p>価格: ¥{{ number_format($item->price) }}</p>
        </div>
    @else
        <p>商品情報が取得できません。</p>
    @endif

    <form method="POST" action="{{ route('address.update', $item->id) }}">
        @csrf

        <label for="postal_code">郵便番号</label>
        <input type="text" name="postal_code" id="postal_code" value="{{ old('postal_code', $address->postal_code ?? '') }}" required>

        <label for="address_line1">住所</label>
        <input type="text" name="address_line1" id="address_line1" value="{{ old('address_line1', $address->address_line1 ?? '') }}" required>

        <label for="address_line2">建物名（任意）</label>
        <input type="text" name="address_line2" id="address_line2" value="{{ old('address_line2', $address->address_line2 ?? '') }}">

        <button type="submit" class="button">住所を保存</button>
    </form>
</div>
@endsection
