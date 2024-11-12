

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
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">



    {{-- fontawesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    {{-- Google font --}}
    <link href="https://fonts.googleapis.com/css2?family=Gothic+A1:wght@400;700&display=swap" rel="stylesheet">

</head>









<body class="main-bg">
    <div id="app">
        @if (!request()->is('order/confirm'))

            <nav class=" row navbar navbar-expand-md navbar-light shadow-sm text-white main-nav d-flex justify-content-between" style="height: 100px">
                <div class="container">
                    <div class="col-2 text-center">
                    @if (request()->is('store/*'))
                        <a class="navbar-brand" href="{{ route('store.home') }}">
                            <img src="{{ asset('images/final-logo.png') }}" alt=""
                                class="logo-img p-0 overflow-hidden m-0"style="height: 100px">
                        </a>
                    @else
                        <a class="navbar-brand 
                        " href="{{ route('home') }}">
                            <img src="{{ asset('images/final-logo.png') }}" alt=""
                                class="logo-img  overflow-hidden m-0  "style="height: 100px">
                        </a>
                    @endif

                    </div>

                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                        <span class="navbar-toggler-icon"></span>
                    </button>


                    {{-- 検索バー --}}
                    <div class=" col-7 collapse navbar-collapse justify-content-center" id="navbarSupportedContent">
                        <!-- Left Side Of Navbar -->
                        @if (request()->is('guest/*'))
                <form action="{{ route('book.search') }}" method="get" class="d-flex align-items-center mx-auto">
                    @csrf
                    <div class="position-relative">
                        <input type="text" id="searchInput" name="search" class="form-control form-control-sm rounded searchInput" style="width: 400px;" placeholder="Search books...">
                        <span id="clearButton" class="clearButton">&times;</span>
                    </div>
                    <button type="submit" class="btn btn-sm btn-warning ms-2 search-icon">
                        <i class="fa-solid fa-magnifying-glass text-white"></i>
                    </button>
                </form>
                    </div>
            @endif

            <!-- ナビゲーションの右端の要素 (Home, Order, ユーザー情報) -->
            <div class="col-2 collapse navbar-collapse justify-content-center text-center " id="navbarSupportedContent">
        

            @if (request()->is('guest/*'))
            <ul class="navbar-nav d-flex align-items-center justify-content-start">
                <!-- Home -->
                <li class="nav-item me-3" title="Home">
                    <a href="{{ route('home') }}" class="nav-link mb-0">
                        <i class="fa-solid fa-house text-white icon-sm fs-1"></i>
                        <p class="text-white mb-0">Home</p>
                    </a>
                </li>
            
                <!-- Order -->
                <li class="nav-item me-3" title="Order">
                    <a href="{{ route('order.show') }}" class="nav-link">
                        <i class="fa-solid fa-cart-shopping text-white fs-1"></i>
                        <p class="text-white mb-0">Order</p>
                    </a>
                </li>
            
                <!-- ユーザー情報 -->
                <li class="nav-item dropdown d-flex flex-column align-items-center mb-0">
                    <button id="account-dropdown" class="btn shadow-none nav-link align-items-center pr-5 ms-0" data-bs-toggle="dropdown">
                        @if (Auth::user()->profile && Auth::user()->profile->avatar)
                            <img src="{{ Auth::user()->profile->avatar }}" alt="{{ Auth::user()->name }}" class="rounded-circle shadow  avatar-sm d-block mx-auto ">
                            <p class="text-white mb-0">{{ Auth::user()->name }}</p>
                        @else
                            <i class="fa-solid fa-circle-user text-white fs-1 icon-sm"></i>
                            <p class="text-white mb-0">{{ Auth::user()->name }}</p>
                        @endif
                    </button>
                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="account-dropdown">
                        {{-- Admin --}}
                        @can('admin')
                            <a class="dropdown-item" href="{{ route('admin.home') }}">
                                <i class="fa-solid fa-user-gear"></i> Admin
                            </a>
                            <hr class="dropdown-divider">
                        @endcan
                
                        {{-- Store Page 仮置き --}}
                        @can('store')
                            <a class="dropdown-item" href="{{ route('store.home') }}">
                                <i class="fa-solid fa-shop"></i> Store page
                            </a>
                            <hr class="dropdown-divider">
                        @endcan
                
                        {{-- role_idが3のユーザー向けのStore Profileリンク --}}
                        @if (Auth::user()->role_id == 3)
                        <a class="dropdown-item" href="{{ route('store.profile') }}">
                            <i class="fa-solid fa-circle-user "></i>Profile
                        </a>
                        <hr class="dropdown-divider">
                        @endif

                        {{-- role_idが3以外のユーザー向けのProfileリンク --}}
                        @if (Auth::user()->role_id != 3)
                        <a href="{{ route('profile.show', Auth::user()->id) }}" class="dropdown-item">
                            <i class="fa-solid fa-circle-user"></i>Profile
                        </a>
                        @endif
                
                        {{-- Logout --}}
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="fa-solid fa-right-from-bracket"></i> {{ __('Logout') }}
                        </a>
                
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </li>
            </ul>
            
            </div>
            @endif

            @if (request()->is('thread/*'))
    <div class="col-2 collapse navbar-collapse justify-content-end text-center " id="navbarSupportedContent">
        <ul class="navbar-nav d-flex align-items-center justify-content-end me-5">
        <!-- Home -->
        <li class="nav-item me-3" title="Home">
            <a href="{{ route('home') }}" class="nav-link mb-0">
                <i class="fa-solid fa-house text-white icon-sm fs-1"></i>
                <p class="text-white mb-0">Home</p>
            </a>
        </li>

        <!-- Thread -->
        <li class="nav-item me-3" title="Thread">
            <a href="{{ route('thread.home') }}" class="nav-link">
                <i class="fa-solid fa-comments text-white fs-1"></i>
                <p class="text-white mb-0">Thread</p>
            </a>
        </li>

        <!-- ユーザー情報 -->
        <li class="nav-item dropdown d-flex flex-column align-items-center mb-0">
            <button id="account-dropdown" class="btn shadow-none nav-link align-items-center pr-5 ms-0" data-bs-toggle="dropdown">
                @if (Auth::user()->profile && Auth::user()->profile->avatar)
                    <img src="{{ Auth::user()->profile->avatar }}" alt="{{ Auth::user()->name }}" class="rounded-circle avatar-sm ">
                    <p class="text-white mb-0">{{ Auth::user()->name }}</p>
                @else
                    <i class="fa-solid fa-circle-user text-white fs-1 icon-sm"></i>
                    <p class="text-white mb-0">{{ Auth::user()->name }}</p>
                @endif
            </button>
            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="account-dropdown">
                {{-- Admin --}}
                @can('admin')
                    <a class="dropdown-item" href="{{ route('admin.home') }}">
                        <i class="fa-solid fa-user-gear"></i> Admin
                    </a>
                    <hr class="dropdown-divider">
                @endcan
        
                {{-- Store Page 仮置き --}}
                @can('store')
                    <a class="dropdown-item" href="{{ route('store.home') }}">
                        <i class="fa-solid fa-shop"></i> Store page
                    </a>
                    <hr class="dropdown-divider">
                @endcan
        
                {{-- Profile --}}
                <a href="{{ route('profile.show', Auth::user()->id) }}" class="dropdown-item">
                    <i class="fa-solid fa-circle-user"></i> Profile
                </a>
        
                {{-- Logout --}}
                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fa-solid fa-right-from-bracket"></i> {{ __('Logout') }}
                </a>
        
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </li>
    </ul>
    </div>
@endif



<ul class="navbar-nav ms-auto text-center mt-4">
    <!-- Authentication Links -->
    @guest
        @if (Route::has('login'))
            <li class="nav-item">
                <a class="nav-link" href="{{ route('login') }}">
                    <p class="fs-4 text-white fw-bold pe-4">Login</p>
                </a>
            </li>
        @endif

        @if (Route::has('register'))
            <li class="nav-item">
                <a class="nav-link" href="{{ route('register') }}">
                    <p class="fs-4 text-white fw-bold pe-3">Register</p>
                </a>
            </li>
        @endif
    @else
        @if (request()->is('store/*'))
        <div class="col-2 collapse navbar-collapse justify-content-end text-center mb-4" id="navbarSupportedContent">
            <ul class="navbar-nav d-flex align-items-center justify-content-end me-5">
            <!-- Home -->
            <li class="nav-item me-3" title="Home">
                <a href="{{ route('store.home') }}" class="nav-link mb-0">
                    <i class="fa-solid fa-house text-white icon-sm fs-1"></i>
                    <p class="text-white mb-0">Home</p>
                </a>
            </li>
    
            <!-- Logout Link -->
            <a class="nav-link d-flex flex-column align-items-center mb-0 me-3"
            href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
             <i class="fa-solid fa-right-from-bracket text-white fs-1"></i>
             <p class="text-white mb-0 ">{{ __('Logout') }}</p>
            </a>

            <!-- Logout Form (Hidden) -->
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>

            
    
            <!-- ユーザー情報 -->
            <li class="nav-item dropdown d-flex flex-column align-items-center mb-0">
                <button id="account-dropdown" class="btn shadow-none nav-link align-items-center pr-5 ms-0" data-bs-toggle="dropdown">
                    @if (Auth::user()->profile && Auth::user()->profile->avatar)
                        <img src="{{ Auth::user()->profile->avatar }}" alt="{{ Auth::user()->name }}" class="rounded-circle avatar-sm ">
                        <p class="text-white mb-0">{{ Auth::user()->name }}</p>
                    @else
                        <i class="fa-solid fa-circle-user text-white fs-1 icon-sm"></i>
                        <p class="text-white mb-0">{{ Auth::user()->name }}</p>
                    @endif
                </button>
                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="account-dropdown">
                    {{-- Admin --}}
                    @can('admin')
                        <a class="dropdown-item" href="{{ route('admin.home') }}">
                            <i class="fa-solid fa-user-gear"></i> Admin
                        </a>
                        <hr class="dropdown-divider">
                    @endcan
            
                    {{-- Store Page 仮置き --}}
                    @can('store')
                        <a class="dropdown-item" href="{{ route('store.home') }}">
                            <i class="fa-solid fa-shop"></i> Store page
                        </a>
                        <hr class="dropdown-divider">
                    @endcan
            
                    {{-- role_idが3のユーザー向けのStore Profileリンク --}}
                    @if (Auth::user()->role_id == 3)
                    <a class="dropdown-item" href="{{ route('store.profile') }}">
                        <i class="fa-solid fa-circle-user "></i>Profile
                    </a>
                    <hr class="dropdown-divider">
                    @endif

                    {{-- role_idが3以外のユーザー向けのProfileリンク --}}
                    @if (Auth::user()->role_id != 3)
                    <a href="{{ route('store.profile', Auth::user()->id) }}" class="dropdown-item">
                        <i class="fa-solid fa-circle-user"></i>Profile
                    </a>
                    @endif
            
                    {{-- Logout --}}
                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fa-solid fa-right-from-bracket"></i> {{ __('Logout') }}
                    </a>
            
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </li>
        </ul>
        </div>
            
        @elseif(request()->is('admin/*'))
        <div class="col-2 collapse navbar-collapse justify-content-end text-center mb-4" id="navbarSupportedContent">
            <ul class="navbar-nav d-flex align-items-center justify-content-end me-5">
            <!-- Home -->
            <li class="nav-item me-3" title="Home">
                <a href="{{ route('admin.home') }}" class="nav-link mb-0">
                    <i class="fa-solid fa-house text-white icon-sm fs-1"></i>
                    <p class="text-white mb-0">Home</p>
                </a>
            </li>
    
            <!-- Logout Link -->
            <a class="nav-link d-flex flex-column align-items-center mb-0 me-3"
            href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
             <i class="fa-solid fa-right-from-bracket text-white fs-1"></i>
             <p class="text-white mb-0 ">{{ __('Logout') }}</p>
            </a>

            <!-- Logout Form (Hidden) -->
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>

            
    
            <!-- ユーザー情報 -->
            <li class="nav-item dropdown d-flex flex-column align-items-center mb-0">
                <button id="account-dropdown" class="btn shadow-none nav-link align-items-center pr-5 ms-0" data-bs-toggle="dropdown">
                    @if (Auth::user()->profile && Auth::user()->profile->avatar)
                        <img src="{{ Auth::user()->profile->avatar }}" alt="{{ Auth::user()->name }}" class="rounded-circle avatar-sm ">
                        <p class="text-white mb-0">{{ Auth::user()->name }}</p>
                    @else
                        <i class="fa-solid fa-circle-user text-white fs-1 icon-sm"></i>
                        <p class="text-white mb-0">{{ Auth::user()->name }}</p>
                    @endif
                </button>
                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="account-dropdown">
                    {{-- Admin --}}
                    @can('admin')
                        <a class="dropdown-item" href="{{ route('admin.home') }}">
                            <i class="fa-solid fa-user-gear"></i> Admin
                        </a>
                        <hr class="dropdown-divider">
                    @endcan
            
                    {{-- Store Page 仮置き --}}
                    @can('store')
                        <a class="dropdown-item" href="{{ route('store.home') }}">
                            <i class="fa-solid fa-shop"></i> Store page
                        </a>
                        <hr class="dropdown-divider">
                    @endcan
            
                   {{-- role_idが3のユーザー向けのStore Profileリンク --}}
                    @if (Auth::user()->role_id == 3)
                    <a class="dropdown-item" href="{{ route('store.profile') }}">
                        <i class="fa-solid fa-circle-user "></i>Profile
                    </a>
                    <hr class="dropdown-divider">
                    @endif

                    {{-- role_idが3以外のユーザー向けのProfileリンク --}}
                    @if (Auth::user()->role_id != 3)
                    <a href="{{ route('profile.show', Auth::user()->id) }}" class="dropdown-item">
                        <i class="fa-solid fa-circle-user"></i>Profile
                    </a>
                    @endif
            
                    {{-- Logout --}}
                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fa-solid fa-right-from-bracket"></i> {{ __('Logout') }}
                    </a>
            
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </li>
        </ul>
        </div>

        @elseif(request()->is('order/*'))
        <div class="col-2 collapse navbar-collapse justify-content-end text-center mb-4" id="navbarSupportedContent">
            <ul class="navbar-nav d-flex align-items-center justify-content-end me-5">
            <!-- Home -->
            <li class="nav-item me-3" title="Home">
                <a href="{{ route('home') }}" class="nav-link mb-0">
                    <i class="fa-solid fa-house text-white icon-sm fs-1"></i>
                    <p class="text-white mb-0">Home</p>
                </a>
            </li>
    
            <!-- Order -->
            <li class="nav-item me-3" title="Order">
                <a href="{{ route('order.show') }}" class="nav-link">
                    <i class="fa-solid fa-cart-shopping text-white fs-1"></i>
                    <p class="text-white mb-0">Order</p>
                </a>
            </li>
    
          
            <!-- ユーザー情報 -->
<li class="nav-item dropdown d-flex flex-column align-items-center mb-0">
    <button id="account-dropdown" class="btn shadow-none nav-link align-items-center pr-5 ms-0" data-bs-toggle="dropdown">
        @if (Auth::user()->profile && Auth::user()->profile->avatar)
            <img src="{{ Auth::user()->profile->avatar }}" alt="{{ Auth::user()->name }}" class="rounded-circle avatar-sm">
            <p class="text-white mb-0">{{ Auth::user()->name }}</p>
        @else
            <i class="fa-solid fa-circle-user text-white fs-1 icon-sm"></i>
            <p class="text-white mb-0">{{ Auth::user()->name }}</p>
        @endif
    </button>
    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="account-dropdown">
        {{-- Admin --}}
        @can('admin')
            <a class="dropdown-item" href="{{ route('admin.home') }}">
                <i class="fa-solid fa-user-gear"></i> Admin
            </a>
            <hr class="dropdown-divider">
        @endcan

        {{-- Store Page 仮置き --}}
        @can('store')
            <a class="dropdown-item" href="{{ route('store.home') }}">
                <i class="fa-solid fa-shop"></i> Store page
            </a>
            <hr class="dropdown-divider">
        @endcan

       {{-- role_idが3のユーザー向けのStore Profileリンク --}}
        @if (Auth::user()->role_id == 3)
        <a class="dropdown-item" href="{{ route('store.profile') }}">
            <i class="fa-solid fa-circle-user "></i>Profile
        </a>
        <hr class="dropdown-divider">
        @endif

        {{-- role_idが3以外のユーザー向けのProfileリンク --}}
        @if (Auth::user()->role_id != 3)
        <a href="{{ route('profile.show', Auth::user()->id) }}" class="dropdown-item">
            <i class="fa-solid fa-circle-user"></i>Profile
        </a>
        @endif


        {{-- Logout --}}
        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="fa-solid fa-right-from-bracket"></i> {{ __('Logout') }}
        </a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
    </div>
</li>

        </ul>
        </div>

        @endif
    @endguest


</ul>
                    </div>
                </div>
            </nav>
        @endif
    @guest
        @else
            @if (request()->is('thread/*'))
                
                <nav class="navbar navbar-expand-md navbar-light shadow-sm text-white sub-nav">
                    <div class="container">
                        <div class="row w-100 justify-content-center text-center">
                            <p class="col-auto px-5 mt-3 fs-5 mx-auto">
                                <a href="{{ route('thread.home') }}" class="text-menu text-decoration-none ">Thread
                                    Home</a>
                            </p>
                            <p class="col-auto px-5 mt-3 fs-5 mx-auto">
                                <a href="{{ route('thread.create') }}" class="text-menu text-decoration-none">Post
                                    Thread</a>
                            </p>
                        </div>
                    </div>
                </nav>

                

            @endif

            
            {{-- genera modal --}}
            @include('layouts.modals.genre')

            @if (request()->is('guest/*'))
                <nav class="navbar navbar-expand-md navbar-light shadow-sm text-white sub-nav">
                    <div class="row mx-auto">
                        <p class="col px-5 mt-3 fs-5 "><a href="{{ route('book.new') }}"
                                class="text-menu text-decoration-none">New</a></p>
                        <p class="col px-5 mt-3 fs-5 "><a href="" class="text-menu text-decoration-none"
                                data-bs-toggle="modal" data-bs-target="#genre-modal">Genre</a></p>
                        <p class="col px-5 mt-3 fs-5 "><a href="{{ route('book.ranking') }}"
                                class="text-menu text-decoration-none">Ranking</a></p>
                        <p class="col px-5 mt-3 fs-5 "><a href="{{ route('book.suggestion') }}"
                                class="text-menu text-decoration-none">Suggestion</a></p>
                        <p class="col px-5 mt-3 fs-5 "><a href="{{ route('thread.home') }}"
                                class="text-menu text-decoration-none">Thread</a></p>
                        <p class="col px-5 mt-3 fs-5 "><a href="{{ route('book.store_list') }}"
                                class="text-menu text-decoration-none">Store</a></p>
                        <p class="col px-5 mt-3 fs-5 "><a href="{{ route('inquiry') }}"
                                class="text-menu text-decoration-none">Inquiry</a></p>
                    </div>
                </nav>
            @endif
        @endguest

        <main class="py-4">
            @yield('content')
        </main>
        {{-- footer here --}}
        @auth
            @if (!request()->is('order/confirm'))
                @include('layouts.footer')
            @endif
        @endauth
    </div>
</body>

</html>
    {{-- search bar --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInputs = document.querySelectorAll('.searchInput');
            const clearButtons = document.querySelectorAll('.clearButton');

            searchInputs.forEach((input, index) => {
                const clearBtn = clearButtons[index]; // inputと対応するclearButtonを取得

                input.addEventListener('input', function() {
                    clearBtn.style.display = input.value.length > 0 ? 'inline-block' : 'none';
                });

                clearBtn.addEventListener('click', function() {
                    input.value = '';
                    clearBtn.style.display = 'none';
                    input.focus();
                });
            });
        });
    </script>


    {{-- Java Script for Graph --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    {{-- java script for popup --}}
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>

    {{-- jQuery ライブラリ  --}}
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>

    {{-- sort in the same page --}}
    <script>
        document.getElementById('genreSelect').addEventListener('change', function() {
            const genreId = this.value;
            if (genreId) {
                window.location.href = `/thread/home?genre_id=${genreId}`; // ジャンルIDをクエリパラメータに追加してURLを生成
            } else {
                window.location.href = '/thread/home'; // ジャンルが未選択の場合は全ての本を表示するページに戻る
            }
        });
    </script>

