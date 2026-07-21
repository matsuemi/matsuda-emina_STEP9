@extends('layouts.app')

@section('title', 'アカウント編集')

@section('content')

<h2 class="mb-4">アカウント情報編集</h2>

<form action="{{ route('account.update') }}" method="POST">
    @csrf

    <div class="mb-3">
        <label>ユーザ名</label>
        <input type="text" name="user_name" class="form-control" value="{{ old('user_name', $user->user_name) }}">
    </div>

    <div class="mb-4">
        <label>Eメール</label>
        <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}">
    </div>

    <div class="mb-3">
        <label>名前</label>
        <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}">
    </div>

    <div class="mb-3">
        <label>カナ</label>
        <input type="text" name="name_kana" class="form-control" value="{{ old('name_kana', $user->name_kana) }}">
    </div>

    <div class="d-flex gap-3">
        <a href="{{ route('mypage') }}" class="btn btn-secondary">
            戻る
        </a>

        <button type="submit" class="btn btn-primary">
            更新
        </button>
    </div>

</form>

@endsection