@extends('layouts.app')

@section('title', '商品登録')

@section('content')
<div class="container">

    <h1 class="mb-4">登録画面</h1>

    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        {{-- 商品名 --}}
        <div class="mb-3">
            <label for="product_name" class="form-label">商品名</label>
            <input type="text" name="product_name" id="product_name" class="form-control" value="{{ old('product_name') }}">
        </div>

        {{-- 価格 --}}
        <div class="mb-3">
            <label for="price" class="form-label">価格</label>
            <input type="number" name="price" id="price" class="form-control" value="{{ old('price') }}">
        </div>

        {{-- 商品説明 --}}
        <div class="mb-3">
            <label for="description" class="form-label">商品説明</label>
            <textarea name="description" id="description" class="form-control" rows="4">{{ old('description') }}</textarea>
        </div>

        {{-- 在庫数 --}}
        <div class="mb-3">
            <label for="stock" class="form-label">在庫数</label>
            <input type="number" name="stock" id="stock" class="form-control" value="{{ old('stock') }}">
        </div>

        {{-- 商品画像 --}}
        <div class="mb-4">
            <label for="img_path" class="form-label d-block">商品画像</label>
            <input type="file" name="img_path" id="img_path">
        </div>

        {{-- ボタン --}}
            <a href="{{ route('products.index') }}" class="btn btn-secondary">戻る</a>
            <a href="{{ route('products.index') }}" class="btn btn btn-primary">登録</a>
    </form>

</div>
@endsection