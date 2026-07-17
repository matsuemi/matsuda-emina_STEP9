@extends('layouts.app')

@section('title', 'マイページ')

@section('content')

<h2 class="mb-4">マイページ</h2>

{{-- アカウント情報 --}}
    <div class="mb-3">
        <a href="{{ route('profile.edit') }}" class="btn btn-primary">
            アカウント編集
        </a>
    </div>

    <div class="row mb-2">
        <div class="col-md-6">
            <strong>ユーザ名：</strong>
            {{ auth()->user()->user_name }}
        </div>

        <div class="col-md-6">
            <strong>名前：</strong>
            {{ auth()->user()->name }}
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <strong>Eメール：</strong>
            {{ auth()->user()->email }}
        </div>

        <div class="col-md-6">
            <strong>カナ：</strong>
            {{ auth()->user()->name_kana }}
        </div>
    </div>

{{-- 出品商品 --}}
<div class="mt-5 d-flex justify-content-between align-items-center mb-3">
    <h4>＜出品商品＞</h4>

    <a href="{{ route('products.create') }}" class="btn btn-primary">
        新規登録
    </a>
</div>

<table class="table align-middle">
    <thead class="table-light">
        <tr>
            <th>商品番号</th>
            <th>商品名</th>
            <th>商品説明</th>
            <th>料金(¥)</th>
            <th></th>
        </tr>
    </thead>

    <tbody>
    @forelse($products as $product)
        <tr>
            <td>{{ $product->id }}</td>
            <td>{{ $product->product_name }}</td>
            <td>{{ $product->description }}</td>
            <td>{{ number_format($product->price) }}</td>
            <td>
                <a href="{{ route('products.owner.show', $product->id) }}" class="btn btn-success">
                    詳細
                </a>
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="5" class="text-center">
                出品した商品はありません。
            </td>
        </tr>
    @endforelse
    </tbody>
</table>

{{-- 購入した商品 --}}
<h4 class="mt-5 mb-3">＜購入した商品＞</h4>

<table class="table align-middle">
    <thead class="table-light">
        <tr>
            <th>商品名</th>
            <th>商品説明</th>
            <th>料金(¥)</th>
            <th>個数</th>
        </tr>
    </thead>

    <tbody>
        <tr>
            <td colspan="4" class="text-center">
                購入した商品はありません。
            </td>
        </tr>
    </tbody>
</table>

@endsection