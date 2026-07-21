<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'CytechEC')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
</head>

<body class="d-flex flex-column min-vh-100">

<header class="bg-primary-subtle py-3">
    <div class="container">

        <div class="d-flex justify-content-between align-items-center">

            <h3 class="mb-0">
                <a href="{{ route('products.index') }}" class="text-decoration-none text-dark">
                    Cytech EC
                </a>
            </h3>

            <div class="d-flex justify-content-end align-items-center gap-3">
                <a href="{{ route('products.index') }}" class="text-decoration-none">
                    Home
                </a>

                <a href="{{ route('mypage') }}" class="text-decoration-none">
                    マイページ
                </a>

                @auth
                    <span>
                        ログインユーザー：{{ auth()->user()->user_name }}
                    </span>

                    <form action="{{ route('logout') }}" method="POST" class="d-inline">
                        @csrf
                        <button class="btn btn-outline-danger btn-sm">
                            ログアウト
                        </button>
                    </form>
                @endauth
            </div>
        </div>
    </div>
</header>

<main class="container my-4 flex-grow-1">

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @yield('content')

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

</main>

<footer class="bg-primary-subtle py-4">

    <div class="container text-center">
        
        <a href="{{ route('contact') }}" class="btn btn-primary mb-3">
            お問い合わせ
        </a>

        <div class="mb-2">

            <a href="{{ route('products.index') }}" class="me-3 text-decoration-none">
                Home
            </a>

            <a href="{{ route('mypage') }}" class="text-decoration-none">
                マイページ
            </a>

        </div>
        <small>&copy; 2026 Company, Inc.</small>
    </div>

</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>