@extends('layouts.app')

@section('title', 'Guest Review')


@section('content')

    <div class="row px-3 mt-4">
        {{-- main --}}
        <div class="col-9">

            {{-- Ranking --}}
            <div class="bg-white rounded px-5 py-2 shadow mb-5">
                <div class="row">
                    <div class="col">
                        <h2 class="h1 fw-bold text-grey mt-3">Ranking</h2>
                    </div>
                    <div class="col text-end ">
                        <a href="{{ route('book.ranking') }}" class="text-grey fs-24">
                            <p class="text-end mt-3 mb-0">
                                more <span class="h4"><i class="fa-solid fa-chevron-right"></i><i
                                        class="fa-solid fa-chevron-right"></i></span>
                            </p>
                        </a>
                    </div>
                </div>
                {{-- Booklist --}}
                <div id="carouselRankingControls" class="carousel slide mt-2">
                    <div class="carousel-inner">
                        {{-- page1 --}}
                        <div class="carousel-item active">
                            <div class="row">
                                @for ($i = 1; $i < 5; $i++)
                                    <div class="col-3">
                                        @if ($i <= 3)
                                            <div class="h1">
                                                {{-- star color --}}
                                                @if ($i == 1)
                                                    <i class="fa-solid fa-crown" style="color: gold"></i>
                                                    {{ $i }}
                                                @elseif ($i == 2)
                                                    <i class="fa-solid fa-crown" style="color: silver"></i>
                                                    {{ $i }}
                                                @elseif ($i == 3)
                                                    <i class="fa-solid fa-crown" style="color: #9A6229"></i>
                                                    {{ $i }}
                                                @endif
                                            </div>
                                        @else
                                            <div class="h1">
                                                <i class="fa-solid fa-star text-white"></i>
                                                {{ $i }}
                                            </div>
                                        @endif
                                        <div class="text-center">
                                            <a href="{{route('book.show_book')}}">
                                                <img src="{{ asset('images/649634.png') }}" class="w-75 shadow"
                                                alt="Image {{ $i }}">
                                             </a>
                                            <a href="{{route('book.show_book')}}" class="text-decoration-none text-primary fs-24 fw-bold">
                                                <p class="mt-4">Book{{ $i }}</p>
                                            </a>
                                            <a href="{{route('book.author_show')}}" class="text-decoration-none h4 fw-bold">
                                                <p>Author</p>
                                            </a>
                                        </div>

                                    </div>
                                @endfor
                            </div>
                        </div>
                        {{-- page2 --}}
                        <div class="carousel-item">
                            <div class="row">
                                @for ($i = 5; $i < 9; $i++)
                                    <div class="col-3">
                                        @if ($i <= 3)
                                            <div class="h1">
                                                {{-- star color --}}
                                                @if ($i == 1)
                                                    <i class="fa-solid fa-star text-gold"></i>
                                                    {{ $i }}
                                                @elseif ($i == 2)
                                                    <i class="fa-solid fa-star text-silver"></i>
                                                    {{ $i }}
                                                @elseif ($i == 3)
                                                    <i class="fa-solid fa-star text-copper"></i>
                                                    {{ $i }}
                                                @endif
                                            </div>
                                        @else
                                            <div class="h1">
                                                <i class="fa-solid fa-star text-white"></i>{{ $i }}
                                            </div>
                                        @endif
                                        <div class="text-center">
                                            <img src="{{ asset('images/649634.png') }}" class="w-75 shadow"
                                                alt="Image {{ $i }}">
                                            <a href="#" class="text-decoration-none text-primary fs-24 fw-bold">
                                                <p class="mt-4">Book{{ $i }}</p>
                                            </a>
                                            <a href="#" class="text-decoration-none h4 fw-bold">
                                                <p>Author</p>
                                            </a>
                                        </div>

                                    </div>
                                @endfor
                            </div>
                        </div>
                        {{-- page3 --}}
                        <div class="carousel-item">
                            <div class="row">
                                @for ($i = 9; $i < 13; $i++)
                                    <div class="col-3">
                                        @if ($i <= 3)
                                            <div class="h1">
                                                {{-- star color --}}
                                                @if ($i == 1)
                                                    <i class="fa-solid fa-crown" style="color: gold"></i>
                                                    {{ $i }}
                                                @elseif ($i == 2)
                                                    <i class="fa-solid fa-crown" style="color: silver"></i>
                                                    {{ $i }}
                                                @elseif ($i == 3)
                                                    <i class="fa-solid fa-crown" style="color: #9A6229"></i>
                                                    {{ $i }}
                                                @endif
                                            </div>
                                        @else
                                            <div class="h1">
                                                <i class="fa-solid fa-star text-white"></i>{{ $i }}
                                            </div>
                                        @endif
                                        <div class="text-center">
                                            <img src="{{ asset('images/649634.png') }}" class="w-75 shadow"
                                                alt="Image {{ $i }}">
                                            <a href="#" class="text-decoration-none text-primary fs-24 fw-bold">
                                                <p class="mt-4">Book{{ $i }}</p>
                                            </a>
                                            <a href="#" class="text-decoration-none h4 fw-bold">
                                                <p>Author</p>
                                            </a>
                                        </div>

                                    </div>
                                @endfor
                            </div>
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselRankingControls"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselRankingControls"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>



            </div>
            {{-- Suggestion --}}
            <div class="bg-white rounded px-5 py-2 shadow my-5">
                <div class="row">
                    <div class="col">
                        <h2 class="h1 fw-bold text-grey mt-3">Suggestion</h2>
                    </div>
                    <div class="col text-end ">
                        <a href="{{ route('book.suggestion') }}" class="text-grey fs-24">
                            <p class="text-end mt-3 mb-0">
                                more <span class="h4"><i class="fa-solid fa-chevron-right"></i><i
                                        class="fa-solid fa-chevron-right"></i></span>
                            </p>
                        </a>
                    </div>
                </div>
                {{-- Booklist --}}
                <div id="carouselSuggestionControls" class="carousel slide mt-2" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        {{-- page1 --}}
                        <div class="carousel-item active">
                            <div class="row">
                                @for ($i = 1; $i < 5; $i++)
                                    <div class="col-3">
                                        <div class="h1">
                                            <i class="fa-solid fa-star text-white"></i>{{ $i }}
                                        </div>
                                        <div class="text-center">
                                            <img src="{{ asset('images/649634.png') }}" class="w-75 shadow"
                                                alt="Image {{ $i }}">
                                            <a href="#" class="text-decoration-none text-primary fs-24 fw-bold">
                                                <p class="mt-4">Book{{ $i }}</p>
                                            </a>
                                            <a href="#" class="text-decoration-none h4 fw-bold">
                                                <p>Author</p>
                                            </a>
                                        </div>

                                    </div>
                                @endfor
                            </div>
                        </div>
                        {{-- page2 --}}
                        <div class="carousel-item">
                            <div class="row">
                                @for ($i = 5; $i < 9; $i++)
                                    <div class="col-3">
                                        <div class="h1">
                                            <i class="fa-solid fa-star text-white"></i>{{ $i }}
                                        </div>
                                        <div class="text-center">
                                            <a href="{{route('book.show_book')}}">
                                                <img src="{{ asset('images/649634.png') }}" class="w-75 shadow"
                                                alt="Image {{ $i }}">
                                             </a>
                                            <a href="{{route('book.show_book')}}" class="text-decoration-none text-primary fs-24 fw-bold">
                                                <p class="mt-4">Book{{ $i }}</p>
                                            </a>
                                            <a href="{{route('book.author_show')}}" class="text-decoration-none h4 fw-bold">
                                                <p>Author</p>
                                            </a>
                                        </div>

                                    </div>
                                @endfor
                            </div>
                        </div>
                        {{-- page3 --}}
                        <div class="carousel-item">
                            <div class="row">
                                @for ($i = 9; $i < 13; $i++)
                                    <div class="col-3">
                                        <div class="h1">
                                            <i class="fa-solid fa-star text-white"></i>{{ $i }}
                                        </div>
                                        <div class="text-center">
                                            <img src="{{ asset('images/649634.png') }}" class="w-75 shadow"
                                                alt="Image {{ $i }}">
                                            <a href="#" class="text-decoration-none text-primary fs-24 fw-bold">
                                                <p class="mt-4">Book{{ $i }}</p>
                                            </a>
                                            <a href="#" class="text-decoration-none h4 fw-bold">
                                                <p>Author</p>
                                            </a>
                                        </div>

                                    </div>
                                @endfor
                            </div>
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselSuggestionControls"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselSuggestionControls"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>



            </div>
            {{-- New --}}
            <div class="bg-white rounded px-5 py-2 shadow my-5">
                <div class="row">
                    <div class="col">
                        <h2 class="h1 fw-bold text-grey mt-3">New</h2>
                    </div>
                    <div class="col text-end ">
                        <a href="{{ route('book.new') }}" class="text-grey fs-24">
                            <p class="text-end mt-3 mb-0">
                                more <span class="h4"><i class="fa-solid fa-chevron-right"></i><i
                                        class="fa-solid fa-chevron-right"></i></span>
                            </p>
                        </a>
                    </div>
                </div>
                {{-- Booklist --}}
                <div id="carouselNewControls" class="carousel slide mt-2" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        {{-- page1 --}}
                        <div class="carousel-item active">
                            <div class="row">
                                @for ($i = 1; $i < 5; $i++)
                                    <div class="col-3">
                                        <div class="h1">
                                            <i class="fa-solid fa-star text-white"></i>{{ $i }}
                                        </div>
                                        <div class="text-center">
                                            <a href="{{route('book.show_book')}}">
                                                <img src="{{ asset('images/649634.png') }}" class="w-75 shadow"
                                                alt="Image {{ $i }}">
                                             </a>
                                            <a href="{{route('book.show_book')}}" class="text-decoration-none text-primary fs-24 fw-bold">
                                                <p class="mt-4">Book{{ $i }}</p>
                                            </a>
                                            <a href="{{route('book.author_show')}}" class="text-decoration-none h4 fw-bold">
                                                <p>Author</p>
                                            </a>
                                        </div>

                                    </div>
                                @endfor
                            </div>
                        </div>
                        {{-- page2 --}}
                        <div class="carousel-item">
                            <div class="row">
                                @for ($i = 5; $i < 9; $i++)
                                    <div class="col-3">
                                        <div class="h1">
                                            <i class="fa-solid fa-star text-white"></i>{{ $i }}
                                        </div>
                                        <div class="text-center">
                                            <img src="{{ asset('images/649634.png') }}" class="w-75 shadow"
                                                alt="Image {{ $i }}">
                                            <a href="#" class="text-decoration-none text-primary fs-24 fw-bold">
                                                <p class="mt-4">Book{{ $i }}</p>
                                            </a>
                                            <a href="#" class="text-decoration-none h4 fw-bold">
                                                <p>Author</p>
                                            </a>
                                        </div>

                                    </div>
                                @endfor
                            </div>
                        </div>
                        {{-- page3 --}}
                        <div class="carousel-item">
                            <div class="row">
                                @for ($i = 9; $i < 13; $i++)
                                    <div class="col-3">
                                        <div class="h1">
                                            <i class="fa-solid fa-star text-white"></i>{{ $i }}
                                        </div>
                                        <div class="text-center">
                                            <img src="{{ asset('images/649634.png') }}" class="w-75 shadow"
                                                alt="Image {{ $i }}">
                                            <a href="#" class="text-decoration-none text-primary fs-24 fw-bold">
                                                <p class="mt-4">Book{{ $i }}</p>
                                            </a>
                                            <a href="#" class="text-decoration-none h4 fw-bold">
                                                <p>Author</p>
                                            </a>
                                        </div>

                                    </div>
                                @endfor
                            </div>
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselNewControls"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselNewControls"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>



            </div>
        </div>

        {{-- sub --}}
        <div class="col-3  bg-grey">
            {{-- New thread list --}}
            <div class="row justify-content-center">
                <div class="col-11 bg-white rounded shadow mt-5">
                    <a href="{{ route('thread.home') }}" class="text-decoration-none">
                        <h3 class="text-grey fw-bold mt-3">New Thread</h3>
                    </a>
                    @for ($i = 0; $i < 5; $i++)
                        <div class="mt-2">
                            <a href="{{ route('thread.content') }}" class="text-decoration-none text-primary h3">Hellow
                                world. Hellow world.</a>

                        </div>
                    @endfor
                    <a href="{{route('thread.home')}}" class="text-grey fs-24 text-decoration-none">
                        <p class="text-end">
                            more <span class="h4"><i class="fa-solid fa-chevron-right"></i><i
                                    class="fa-solid fa-chevron-right"></i></span>
                        </p>
                    </a>
                </div>
            </div>


            {{-- advertisement --}}
            <div class="mt-5">
                @for ($i = 0; $i < 3; $i++)
                    <div class="mt-2">
                        <a href="#" class="text-decoration-none text-white">
                            <div class="bg-adv mx-auto">
                                <p class="h1 ">Advertisement</p>
                            </div>
                        </a>

                    </div>
                @endfor
            </div>

        </div>
    </div>









@endsection
