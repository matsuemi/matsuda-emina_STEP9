@extends('layouts.app')

@section('title', '商品詳細')

@section('content')
<div class="container">

    <h2 class="mb-4">出品商品詳細</h2>

    <div class="mb-3">
        <strong>商品名：</strong>
        {{ $product->product_name }}
    </div>

    <div class="mb-3">
        <strong>説明：</strong>
        {{ $product->description }}
    </div>

    <div class="d-flex align-items-center mb-3">
        <strong class="me-3">画像：</strong>
        
        @if($product->img_path)
            <img src="{{ asset('storage/' . $product->img_path) }}" alt="{{ $product->product_name }}" width="200">
        @else
            <span>画像なし</span>
        @endif
    </div>

    <div class="mb-4">
        <strong>金額：</strong>
        ¥{{ number_format($product->price) }}
    </div>

    <div class="d-flex justify-content-left gap-3">

        <a href="{{ route('products.edit', $product->id) }}" class="btn btn-primary">
            編集
        </a>

        <form action="{{ route('products.destroy', $product->id) }}" method="POST">
            @csrf
            @method('DELETE')

            <button type="submit" class="btn btn-danger">
                削除する
            </button>
        </form>

        <a href="{{ route('mypage') }}" class="btn btn-secondary">
            戻る
        </a>
    </div>
</div>
@endsection