<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} | @yield('title')</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
    integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    {{-- CSS Style --}}
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    


    {{-- fontawesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    {{-- Google font --}}
    <link href="https://fonts.googleapis.com/css2?family=Gothic+A1:wght@400;700&display=swap" rel="stylesheet">

    {{-- Java Script for Graph --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body class="main-bg" style="background-color: #FFFCF2">
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light shadow-sm text-white main-nav" style="height: 100px">
            <div class="container">
                <a class="navbar-brand" href="{{route('home')}}">
                    <img src="{{asset("images/final-logo.png")}}" alt="" class="logo-img p-0 overflow-hidden mb-0 p-0"style="height: 100px">
                </a>
                


                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse justify-content-center" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mx-auto">
                        {{-- if the url request is not admin/* (!request()->is(''))--}}

                            <ul class="navbar-nav ms-auto ">

                                @guest
                                @else
                                @if(request()->is('guest/*'))
                                    <form action="#" style="width: 500px" class="d-flex">
                                        <div class="row ms-auto">
                                            <div class="col pe-0 position-relative">
                                                <input type="text" id="searchInput" name="search" class="form-control form-control-sm rounded" style="width: 400px" placeholder="Search books..." style="width: 250px;">
                                                <button type="button" id="clearButton" class="btn btn-sm position-absolute end-0 top-50 translate-middle-y rounded" style="display: none; right: 30px;">
                                                    x
                                                </button>
                                            </div>
                                            <div class="col ps-1">
                                                <button type="submit" class="btn btn-warning btn-sm search-icon">
                                                    <i class="fa-solid fa-magnifying-glass text-white"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </form>

                                    <script>
                                        const searchInput = document.getElementById('searchInput');
                                        const clearButton = document.getElementById('clearButton');

                                        // 入力時にクリアボタンの表示・非表示を切り替える
                                        searchInput.addEventListener('input', function() {
                                            if (searchInput.value) {
                                                clearButton.style.display = 'inline';
                                            } else {
                                                clearButton.style.display = 'none';
                                            }
                                        });

                                        // クリアボタンを押すと検索フィールドをクリア
                                        clearButton.addEventListener('click', function() {
                                            searchInput.value = '';
                                            clearButton.style.display = 'none';
                                            searchInput.focus();  // フィールドにフォーカスを戻す
                                        });
                                    </script>
                                @endif
                                @endguest
                            </ul>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto text-center mt-4">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}"><p class="fs-4 text-white fw-bold pe-4">Login</p></a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}"><p class="fs-4 text-white fw-bold pe-3">Register</p></a>
                                </li>
                            @endif
                        @else

                            {{-- Home --}}
                            <li class="nav-item me-3" title="Home">
                                <a href="{{route('home')}}" class="nav-link">
                                    <i class="fa-solid fa-house text-white icon-sm fs-1"></i>
                                    <p class="text-white">Home</p>
                                </a>
                            </li>

                            {{-- order --}}
                            <li class="nav-item me-3" title="Order">
                                <a href="#" class="nav-link">
                                    <i class="fa-solid fa-cart-shopping text-white fs-1"></i>
                                    <p class="text-white">Order</p>
                                </a>
                            </li>

                            {{-- user profile--}}
                            {{-- Account --}}
                            <li class="nav-item dropdown">

                                <button id="account-dropdown" class="btn shadow-none nav-link" data-bs-toggle="dropdown">
                                    @if (Auth::user()->avatar)
                                        <img src="{{ Auth::user()->avatar }}" alt="{{ Auth::user()->name }}" class="rounded-circle avatar-sm">
                                        <p class="text-white">{{Auth::user()->name}}</p>
                                    @else
                                        <i class="fa-solid fa-circle-user text-white fs-1 icon-sm"></i>
                                        <p class="text-white">{{Auth::user()->name}}</p>
                                    @endif

                                </button>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="account-dropdown">
                                    {{-- Profile --}}
                                    <a href="" class="dropdown-item">
                                        <i class="fa-solid fa-circle-user"></i> Profile
                                    </a>

                                    {{-- Logout --}}
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                    <i class="fa-solid fa-right-from-bracket"></i>  {{ __('Logout') }}
                                    </a>

                                    {{-- Store Page 仮置き --}}
                                    <a class="dropdown-item" href="{{ url('/store/home') }}">
                                        <i class="fa-solid fa-shop"></i> Store page
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        @guest
        @else
        @if(request()->is('thread/*'))
        <nav class="navbar navbar-expand-md navbar-light shadow-sm text-white sub-nav">
            <div class="container">
                <div class="row w-100 justify-content-center text-center">
                    <p class="col-auto px-5 mt-3 fs-5 mx-auto">
                        <a href="#" class="text-menu text-decoration-none ">Thread Home</a>
                    </p>
                    <p class="col-auto px-5 mt-3 fs-5 mx-auto">
                        <a href="#" class="text-menu text-decoration-none">Post Thread</a>
                    </p>
                </div>
            </div>
        </nav>
        
        @endif
        @if(request()->is('guest/*'))
            <nav  class="navbar navbar-expand-md navbar-light shadow-sm text-white sub-nav">
                <div class="row mx-auto">
                    <p class="col px-5 mt-3 fs-5 "><a href="{{route('book.new')}}" class="text-menu text-decoration-none">New</a></p>
                    <p class="col px-5 mt-3 fs-5 "><a href="" class="text-menu text-decoration-none">Genre</a></p>
                    <p class="col px-5 mt-3 fs-5 "><a href="{{route('book.ranking')}}" class="text-menu text-decoration-none">Ranking</a></p>
                    <p class="col px-5 mt-3 fs-5 "><a href="{{route('book.suggestion')}}" class="text-menu text-decoration-none">Suggestion</a></p>
                    <p class="col px-5 mt-3 fs-5 "><a href="" class="text-menu text-decoration-none">Thread</a></p>
                    <p class="col px-5 mt-3 fs-5 "><a href="{{route('book.store_list')}}" class="text-menu text-decoration-none">Store</a></p>
                    <p class="col px-5 mt-3 fs-5 "><a href="{{route('inquiry')}}" class="text-menu text-decoration-none">Inquiry</a></p>
                </div>
            </nav>
        @endif
        @endguest

        <main class="py-4">
            @yield('content')
        </main>
    </div>
    {{-- footer here --}}
        @auth
            @include('layouts.footer')
        @endauth

</body>
</html>
