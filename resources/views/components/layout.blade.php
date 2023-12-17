<!DOCTYPE html>
<html lang="sk">
<head>
    <title>Pivo z Okolia Zvolena</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
            crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}" />
    <script async src="{{ asset('js/app.js')}}"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <meta name="csrf-token" content="{{ csrf_token() }}">

</head>
<body>
<nav class="navbar fixed-top navbar-expand-lg">
    <div class="container-fluid">
        <div class="logo">
            <img src="{{asset("images/svg/logo.svg")}}" alt="logo" width="50" height="40">
        </div>

        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="white" class="bi bi-three-dots" viewBox="0 0 16 16">
                <path d="M3 9.5a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3z"/>
            </svg>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav" >
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="/">
                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="20" fill="white" class="bi bi-house" viewBox="0 0 16 16">
                            <path d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L2 8.207V13.5A1.5 1.5 0 0 0 3.5 15h9a1.5 1.5 0 0 0 1.5-1.5V8.207l.646.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.707 1.5ZM13 7.207V13.5a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5V7.207l5-5 5 5Z"/>
                        </svg>
                        Domov
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/beers">
                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="20" fill="white" class="bi bi-bag" viewBox="0 0 16 16">
                            <path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1zm3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4h-3.5zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V5z"/>
                        </svg>
                        Predaj
                    </a>
                </li>
            </ul>

            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a href="/cart" class="nav-link cart">
                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="20" fill="white" class="bi bi-cart2" viewBox="0 0 16 16">
                            <path d="M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1 .485.621l-1.5 6A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0 1-.5-.5zM3.14 5l1.25 5h8.22l1.25-5H3.14zM5 13a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0zm9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0z"/>
                        </svg>
                    </a>
                </li>

                @auth
                    <li class="nav-item mt-2">
                        <span class="navbar-text">Prihlásený používateľ: <b>{{auth()->user()?->name}}</b></span>
                    </li>

                    <li class="nav-item">
                        <form class="inline" method="POST" action="/logout">
                            @csrf
                            <button class="nav-link" type="submit">Odhlásenie</button>
                        </form>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="/login">Prihlásenie</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/register">Registrácia</a>
                    </li>
                @endauth

            </ul>

        </div>
    </div>
</nav>

<main>
    {{$slot}}
</main>

<footer>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h6 class="text-uppercase fw-bold mb-4">
                    Pivo z okolia Zvolena
                </h6>
                <p>
                    V našom remeselnom pivovare predávame najlepšie pivo z okolia Zvolena.
                </p>
            </div>
            <div class="col-md-3">
                <h6 class="fw-bold mb-4">
                    Linky
                </h6>
                <ul class="list-unstyled">
                    <li><a href="/" class="text-reset">Domov</a></li>
                    <li><a href="/index" class="text-reset">Predaj</a></li>
                </ul>
            </div>
            <div class="col-md-3">
                <h6 class="fw-bold mb-4">Kontakt</h6>
                <p>29. augusta 940/3, 960 01 Zvolen</p>
            </div>
        </div>
    </div>
</footer>
</body>
<x-message />
</html>
