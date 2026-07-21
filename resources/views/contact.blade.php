@extends('layouts.app')

@section('title', 'お問い合わせ')

@section('content')

<h2 class="mb-4">お問い合わせフォーム</h2>

<form action="{{ route('contact.send') }}" method="POST">

    @csrf

    <div class="mb-3">
        <label class="form-label">名前</label>
        <input type="text" name="name" class="form-control" value="{{ old('name') }}">
    </div>

    <div class="mb-3">
        <label class="form-label">メールアドレス</label>
        <input type="email" name="email" class="form-control" value="{{ old('email') }}">
    </div>

    <div class="mb-4">
        <label class="form-label">お問い合わせ内容</label>
        <textarea name="message" rows="6" class="form-control">{{ old('message') }}</textarea>

        @error('message')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="d-flex gap-3">
        <button class="btn btn-primary">
            送信
        </button>

        <a href="{{ route('products.index') }}" class="btn btn-secondary">
            戻る
        </a>
    </div>

</form>

@endsection