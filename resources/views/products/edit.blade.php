@extends('layouts.app')

@section('title', '商品編集')

@section('content')
<div class="container">

    <h1 class="mb-4">出品商品編集</h1>

    <form action="{{ route('products.update', $product->id) }}"
        method="POST"
        enctype="multipart/form-data">
        @csrf
        @method('PUT')

        {{-- 商品名 --}}
        <div class="mb-3">
            <label class="form-label">商品名</label>
            <input type="text"
                   name="product_name"
                   class="form-control"
                   value="{{ old('product_name', $product->product_name) }}">
        </div>

        {{-- 価格 --}}
        <div class="mb-3">
            <label class="form-label">価格</label>
            <input type="number"
                   name="price"
                   class="form-control"
                   value="{{ old('price', $product->price) }}">
        </div>

        {{-- 商品説明 --}}
        <div class="mb-3">
            <label class="form-label">商品説明</label>
            <textarea name="description"
                      class="form-control"
                      rows="4">{{ old('description', $product->description) }}</textarea>
        </div>

        {{-- 在庫数 --}}
        <div class="mb-3">
            <label class="form-label">在庫数</label>
            <input type="number"
                   name="stock"
                   class="form-control"
                   value="{{ old('stock', $product->stock) }}">
        </div>

        {{-- 商品画像 --}}
        <div class="mb-4">
            <label class="form-label d-block">商品画像</label>

            @if($product->img_path)
                <img src="{{ asset('storage/' . $product->img_path) }}" width="150" class="mb-2">
            @endif
            <input type="file" name="img_path">
        </div>

        <div class="d-flex justify-content-left gap-3">
            <a href="{{ route('products.owner.show', $product->id) }}" class="btn btn-secondary">
                戻る
            </a>

            <button type="submit" class="btn btn-primary">
                更新
            </button>
        </div>

    </form>

</div>
@endsection