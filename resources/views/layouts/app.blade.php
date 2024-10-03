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
                    <img src="{{asset("images/final-logo.png")}}" alt="" class="logo-img p-0 overflow-hidden m-0"style="height: 100px">
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
                                    @elseif(request()->is('/'))
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
                        @if(request()->is('store/*'))

                        <div class="d-flex pt-2 me-4 mb-4 align-items-center">
                            <!-- Home Link -->
                            <a href="{{route('store.home')}}" class="nav-link d-flex flex-column align-items-center mb-0 me-4">
                                <i class="fa-solid fa-house text-white icon-sm fs-1"></i>
                                <p class="text-white mb-0">Home</p>
                            </a>

                            <!-- Logout Link -->
                            <a class="nav-link d-flex flex-column align-items-center mb-0 me-4" href="{{ route('logout') }}"
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="fa-solid fa-right-from-bracket text-white fs-1"></i>
                                <p class="text-white mb-0 mt-1">{{ __('Logout') }}</p>
                            </a>

                            <!-- Logout Form (Hidden) -->
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>

                            <!-- User Profile Dropdown -->
                            <li class="nav-item dropdown d-flex flex-column align-items-center mb-0">
                                <button id="account-dropdown" class="btn shadow-none nav-link d-flex flex-column align-items-center" data-bs-toggle="dropdown">
                                    @if (Auth::user()->avatar)
                                        <img src="{{ Auth::user()->avatar }}" alt="{{ Auth::user()->name }}" class="rounded-circle avatar-sm">
                                        <p class="text-white mb-0">{{Auth::user()->name}}</p>
                                    @else
                                        <i class="fa-solid fa-circle-user text-white fs-1 icon-sm"></i>
                                        <p class="text-white mb-0">{{Auth::user()->name}}</p>
                                    @endif
                                </button>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="account-dropdown">
                                    <!-- Profile -->
                                    <a href="{{route('store.profile')}}" class="dropdown-item">
                                        <i class="fa-solid fa-circle-user"></i> Profile
                                    </a>
                                </div>
                            </li>
                        </div>

                        @elseif(request()->is('admin/*'))
                        <div class="pt-2 me-4">
                            <a class="dropdown-item" href="{{ route('logout') }}" class="mb-0 "
                            onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                            <i class="fa-solid fa-right-from-bracket  d-block fs-1"></i><p class="mt-1">{{ __('Logout') }}</p>
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>

                            <li class="nav-item dropdown">

                                <button id="account-dropdown" class="btn shadow-none nav-link" data-bs-toggle="dropdown">
                                    @if (Auth::user()->avatar)
                                        <img src="{{ Auth::user()->avatar }}" alt="{{ Auth::user()->name }}" class="rounded-circle avatar-sm">
                                        <p class="text-white mb-0">{{Auth::user()->name}}</p>
                                    @else
                                        <i class="fa-solid fa-circle-user text-white fs-1 icon-sm"></i>
                                        <p class="text-white mb-0">{{Auth::user()->name}}</p>
                                    @endif

                                </button>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="account-dropdown">
                                    {{-- Profile --}}
                                    <a href="{{route('store.profile')}}" class="dropdown-item">
                                        <i class="fa-solid fa-circle-user"></i> Profile
                                    </a>
                                </div>
                            </li>
                        @else
                            {{-- Home --}}
                            <li class="nav-item me-3" title="Home">
                                <a href="{{route('home')}}" class="nav-link mb-0">
                                    <i class="fa-solid fa-house text-white icon-sm fs-1"></i>
                                    <p class="text-white mb-0">Home</p>
                                </a>
                            </li>

                            {{-- order --}}
                            <li class="nav-item me-3" title="Order">
                                <a href="{{route('order.show')}}" class="nav-link">
                                    <i class="fa-solid fa-cart-shopping text-white fs-1"></i>
                                    <p class="text-white mb-0">Order</p>
                                </a>
                            </li>

                            {{-- user profile--}}
                            {{-- Account --}}
                            <li class="nav-item dropdown">

                                <button id="account-dropdown" class="btn shadow-none nav-link" data-bs-toggle="dropdown">
                                    @if (Auth::user()->avatar)
                                        <img src="{{ Auth::user()->avatar }}" alt="{{ Auth::user()->name }}" class="rounded-circle avatar-sm">
                                        <p class="text-white mb-0">{{Auth::user()->name}}</p>
                                    @else
                                        <i class="fa-solid fa-circle-user text-white fs-1 icon-sm"></i>
                                        <p class="text-white mb-0">{{Auth::user()->name}}</p>
                                    @endif

                                </button>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="account-dropdown">
                                    {{-- Admin --}}
                                    @can('admin')
                                    <a  class="dropdown-item" href="{{ route('admin.home') }}">
                                        <i class="fa-solid fa-user-gear"></i> Admin
                                    </a>
                                    <hr class="dropdown-divider">
                                    @endcan
                                    {{-- Profile --}}
                                    <a href="{{route('profile.show')}}" class="dropdown-item">
                                        <i class="fa-solid fa-circle-user"></i> Profile
                                    </a>

                                    {{-- Logout --}}
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        <i class="fa-solid fa-right-from-bracket"></i>  {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>

                                    {{-- Store Page 仮置き --}}
                                    <a class="dropdown-item" href="{{ url('/store/home') }}">
                                        <i class="fa-solid fa-shop"></i> Store page
                                    </a>

                                </div>
                            </li>
                        @endif
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
                        <a href="{{route('thread.home')}}" class="text-menu text-decoration-none ">Thread Home</a>
                    </p>
                    <p class="col-auto px-5 mt-3 fs-5 mx-auto">
                        <a href="{{route('thread.create')}}" class="text-menu text-decoration-none">Post Thread</a>
                    </p>
                </div>
            </div>
        </nav>
        @endif
        {{-- genera modal --}}
        <div class="modal fade" id="genre-modal">
            <div class="modal-dialog ">
                <div class="modal-content border-0  genre-modal-bg w-75">
                    <div class="modal-header border-secoondaryr">
                        <h5 class="modal-title text-secondary ps-4 p-0">
                            Select Genre
                        </h5>
                    </div>
                    <div class="modal-body text-secondary mx-auto">
                        <form action="#" method="post" class="ms-0 mt-3 p-0">
                            @csrf
                            <div class="row ms-0">
                                <div class="col">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="Comic" id="defaultCheck1">
                                        <label class="form-check-label" for="defaultCheck1">
                                            Comic
                                        </label>
                                    </div>

                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="Fantasy" id="defaultCheck2">
                                        <label class="form-check-label" for="defaultCheck2">
                                            Fantasy
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="Horror" id="defaultCheck3">
                                        <label class="form-check-label" for="defaultCheck3">
                                            Horror
                                        </label>
                                    </div>

                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value=" Mystey" id="defaultCheck4">
                                        <label class="form-check-label" for="defaultCheck4">
                                            Mystey
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="History" id="defaultCheck5">
                                        <label class="form-check-label" for="defaultCheck5">
                                            History
                                        </label>
                                    </div>
                                </div>
                                <div class="col"></div>
                                <div class="col"></div>
                                <div class="col"></div>
                                <div class="col"></div>
                                <div class="col me-5">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value=" Comic" id="defaultCheck6">
                                        <label class="form-check-label" for="defaultCheck6">
                                            Comic
                                        </label>
                                    </div>

                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="Fantasy" id="defaultCheck7">
                                        <label class="form-check-label" for="defaultCheck7">
                                            Fantasy
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="defaultCheck8">
                                        <label class="form-check-label" for="defaultCheck8">
                                            Horror
                                        </label>
                                    </div>

                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="defaultCheck9">
                                        <label class="form-check-label" for="defaultCheck9">
                                            Mystey
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="defaultCheck10">
                                        <label class="form-check-label" for="defaultCheck10">
                                            History
                                        </label>
                                    </div>
                                </div>
                            </div>


                            <button type="submit" class="btn btn-warning text-white mx-auto mt-5 w-100">Search</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>


        @if(request()->is('guest/*'))
            <nav  class="navbar navbar-expand-md navbar-light shadow-sm text-white sub-nav">
                <div class="row mx-auto">
                    <p class="col px-5 mt-3 fs-5 "><a href="{{route('book.new')}}" class="text-menu text-decoration-none">New</a></p>

                    <p class="col px-5 mt-3 fs-5 "><a type ="buttom" class="text-menu text-decoration-none" data-bs-toggle="modal" data-bs-target="#genre-modal">Genre</a></p>

                    <p class="col px-5 mt-3 fs-5 "><a href="{{route('book.ranking')}}" class="text-menu text-decoration-none">Ranking</a></p>
                    <p class="col px-5 mt-3 fs-5 "><a href="{{route('book.suggestion')}}" class="text-menu text-decoration-none">Suggestion</a></p>
                    <p class="col px-5 mt-3 fs-5 "><a href="{{route('thread.home')}}" class="text-menu text-decoration-none">Thread</a></p>
                    <p class="col px-5 mt-3 fs-5 "><a href="{{route('book.store_list')}}" class="text-menu text-decoration-none">Store</a></p>
                    <p class="col px-5 mt-3 fs-5 "><a href="{{route('inquiry')}}" class="text-menu text-decoration-none">Inquiry</a></p>
                </div>
            </nav>
            @elseif(request()->is('/'))
            <nav  class="navbar navbar-expand-md navbar-light shadow-sm text-white sub-nav">
                <div class="row mx-auto">
                    <p class="col px-5 mt-3 fs-5 "><a href="{{route('book.new')}}" class="text-menu text-decoration-none">New</a></p>
                    <p class="col px-5 mt-3 fs-5 "><a href="" class="text-menu text-decoration-none" data-bs-toggle="modal" data-bs-target="#genre-modal">Genre</a></p>

                    <p class="col px-5 mt-3 fs-5 "><a href="{{route('book.ranking')}}" class="text-menu text-decoration-none">Ranking</a></p>
                    <p class="col px-5 mt-3 fs-5 "><a href="{{route('book.suggestion')}}" class="text-menu text-decoration-none">Suggestion</a></p>
                    <p class="col px-5 mt-3 fs-5 "><a href="{{route('thread.home')}}" class="text-menu text-decoration-none">Thread</a></p>
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
