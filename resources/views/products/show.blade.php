@extends('layouts.app')

@section('title', '商品詳細')

@section('content')

<h2 class="mb-4">商品詳細</h2>

<div class="mb-2">
    <strong>商品名：</strong>
    {{ $product->product_name }}
</div>

<div class="mb-2">
    <strong>説明：</strong>
    {{ $product->description }}
</div>

<div class="mb-2 d-flex align-items-center">
    <strong class="me-2">画像：</strong>

    @if($product->img_path)
        <img src="{{ asset('storage/' . $product->img_path) }}" width="200" class="img-thumbnail">
    @else
        画像なし
    @endif
</div>

<div class="mb-2">
    <strong>金額：</strong>
    ¥{{ number_format($product->price) }}
</div>

<div class="mb-2">
    <strong>会社：</strong>
    {{ $product->company->company_name }}
</div>

<div class="mb-3">
    <form action="{{ route('products.like', $product->id) }}" method="POST">
        @csrf

        <button type="submit" class="btn btn-link p-0 border-0 fs-4">

        @if($product->likes->contains('user_id', auth()->id()))
            <i class="fa-solid fa-heart text-danger"></i>
            @else
            <i class="fa-solid fa-heart text-secondary"></i>
            @endif
    </form>

<div class="d-flex gap-3">
    <button class="btn btn-primary">
        カートに追加する
    </button>

    <a href="{{ route('products.index') }}" class="btn btn-secondary">
        戻る
    </a>
</div>

@endsection