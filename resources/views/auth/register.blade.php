<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pendaftaran User CMS Museum</title>

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('css/pages/signin/bootstrap.min.css') }}" rel="stylesheet">

    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }

    </style>

    <!-- Custom styles for this template -->
    <link href="{{ asset('css/pages/signin/signin.css') }}" rel="stylesheet">
</head>

<body class="text-center">

    <main class="form-signin">
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <h1 class="h3 mb-3 fw-normal">Pendaftaran User</h1>
            <h1 class="h3 mb-1 fw-normal">CMS Museum</h1>
            <br>

            <div class="form-floating">
                <input type="text" name="name" class="form-control" id="name" placeholder="Maulvie"
                    value="{{ old('name') }}" required autocomplete="name" autofocus>
                <label for="name">Nama</label>
            </div>
            <div class="form-floating">
                <input type="email" name="email" class="form-control" id="email" placeholder="maulvie@dinamika.ac.id"
                    value="{{ old('email') }}" required autocomplete="email">
                <label for="email">Email</label>
            </div>
            <div class="form-floating">
                <input type="password" name="password" class="form-control" id="password" placeholder="Password"
                    required>
                <label for="password">Password</label>
            </div>
            <div class="form-floating">
                <input type="password" name="password_confirmation" class="form-control" id="password-confirm"
                    placeholder="Konfirmasi Password" required>
                <label for="password-confirm">Konfirmasi Password</label>
            </div>
            <button class="w-100 btn btn-lg btn-primary" type="submit">Daftar</button>
            <p class="mt-5 mb-3 text-muted">&copy; 2021 Universitas Dinamika Surabaya</p>
        </form>
    </main>

</body>

</html>
