@extends('layouts.app')

@section('title', '商品出品')

@section('css')
<link rel="stylesheet" href="{{ asset('css/items/create.css') }}">
@endsection

@section('content')
<div class="sell-container">
    <h1>商品を出品する</h1>
    
    <form action="{{ route('items.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <label for="name">商品名</label>
        <input type="text" name="name" id="name" required>

        <label for="category">カテゴリ</label>
        <select name="category" id="category">
            <option value="家電">家電</option>
            <option value="ファッション">ファッション</option>
            <option value="本">本</option>
        </select>

        <label for="description">商品説明</label>
        <textarea name="description" id="description" required></textarea>

        <label for="price">価格</label>
        <input type="number" name="price" id="price" required>

        <label for="image">商品画像</label>
        <input type="file" name="image" id="image">

        <button type="submit">出品する</button>
    </form>
</div>
@endsection
