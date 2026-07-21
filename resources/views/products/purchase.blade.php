@extends('layouts.app')

@section('title', '購入画面')

@section('content')

<h2 class="mb-4">購入画面</h2>

<div class="mb-2">
    <strong>商品名：</strong>
    {{ $product->product_name }}
</div>

<div class="mb-2">
    <strong>説明：</strong>
    {{ $product->description }}
</div>

<div class="mb-2">
    @if($product->img_path)
        <img src="{{ asset('storage/'.$product->img_path) }}" width="200" class="img-thumbnail">
    @endif
</div>

<form action="{{ route('products.purchase.store', $product->id) }}" method="POST">
    @csrf

    <div class="mb-2">
        <input type="number" name="quantity" value="1" min="1" max="{{ $product->stock }}" class="form-control" style="width:80px;">
    </div>

    <div class="mb-2">
        <strong>金額：</strong>
        ¥{{ number_format($product->price) }}
    </div>

    <div class="mb-2">
        <strong>残り：</strong>
        {{ $product->stock }}
    </div>

    <div class="mb-4">
        <strong>会社：</strong>
        {{ $product->company->company_name }}
    </div>

    <button type="submit" class="btn btn-primary">
        購入する
    </button>

    <a href="{{ route('products.show', $product->id) }}" class="btn btn-secondary">
        戻る
    </a>

</form>

@endsection