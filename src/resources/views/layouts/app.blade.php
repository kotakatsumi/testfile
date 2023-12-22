<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('assets/css/common.css') }}">
    <title>Document</title>
    @yield('css')
</head>
<body class="body-area">
    <header class="header-index">
        <p class="header-title">FashionablyLate</p>
    </header>

    <main class="main-area">
        @yield('content')
    </main>
</body>
</html>