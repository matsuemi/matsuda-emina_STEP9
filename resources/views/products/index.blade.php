@extends('layouts.app')

@section('title', '商品一覧')

@section('content')
<div class="container">

    <h1>商品一覧</h1>

    <form action="{{ route('products.index') }}" method="GET" class="my-3">
        <div class="row align-items-center">
            <div class="col-4">
                <input type="text" name="keyword" class="form-control" placeholder="商品名を入力" value="{{ request('keyord') }}">
            </div>
            <div class="col-md-2">
                <input type="number" name="min_price" class="form-control" placeholder="最低価格" value="{{ request('min_price') }}">
            </div>
            <div class="col-md-1 text-center">
                ～
            </div>
            <div class="col-md-2">
                <input type="number" name="max_price" class="form-control" placeholder="最高価格" value="{{ request('max_price') }}">
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary">検索</button>
            </div>
        </div>
    </form>

    <table class="table table align-middle">
        <thead>
            <tr>
                <th>商品番号</th>
                <th>商品名</th>
                <th>商品説明</th>
                <th>画像</th>
                <th>料金(¥)</th>
            </tr>
        </thead>
        <tbody>
            @forelse($products as $product)
            <tr>
            <td>{{ $product->id }}</td>
            <td>{{ $product->product_name }}</td>
            <td>{{ $product->description }}</td>
                <td>
                    {{--商品画像が存在する場合--}}
                    @if($product->img_path)
                    <img src="{{ asset('storage/' .$product->img_path) }}" width="100">
                    {{--存在しない場合--}}
                    @else
                    画像なし
                    @endif
                </td>
                <td>{{ number_format($product->price) }}</td>
                <td>
                    <a href="{{ route('products.show', $product->id) }}" class="btn btn-success">詳細</a>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="text-center">該当する商品はありません。</td>
            </tr>
            @endforelse
        </tbody>
    </table>

</div>
@endsection