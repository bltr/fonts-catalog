<!DOCTYPE html>
<html>
<head>
    {!! \Meta::toHtml() !!}
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" sizes="16x16" href="/favicon-16x16.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="manifest" href="/site.webmanifest">

    @vite(['resources/js/app.js'])
</head>
<body>

<header>
    <nav class="navbar navbar-expand-lg bg-body-secondary sticky-top">
        <div class="container">
            <a class="navbar-brand" href="{{ url('') }}">
                <img src="{{ url('logo.svg') }}" alt="{{ config('app.name') }}">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarContent">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('category', 'rukopisnye') }}">Рукописные</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('category', 'goticheskie') }}">Готические</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('category', 'dekorativnye') }}">Декоративные</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('category', 'prazdniki') }}">Праздники</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('category', 'kartinki_ikonki') }}">Картинки, иконки</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>

<div class="container">
    <div class="row my-5">
        <main class="col-lg-9">
            @yield('content')
        </main>

        <aside class="col-lg-3 d-none d-lg-block">
            <nav>
                <x-categories-tree />
            </nav>
        </aside>
    </div>
</div>

<footer class="container-fluid bg-body-secondary">
    <div class="row p-4">
        <div class="col text-center">
            © 2008-2023 ALLSHRIFT.RU
        </div>
    </div>
</footer>

</body>
</html>
