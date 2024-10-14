@extends('layouts.app')

@section('title', 'Guest Review')


@section('content')

    <div class="row px-3 mt-4">
        {{-- main --}}
        <div class="col-9">

            {{-- Ranking --}}
            <div class="bg-white rounded px-5 py-2 shadow mb-5 list-board">
                <div class="row">
                    <div class="col">
                        <h2 class="h1 fw-bold text-grey mt-3">Ranking</h2>
                    </div>
                    <div class="col text-end ">
                        <p class="text-end mt-3 mb-0">
                            <a href="{{ route('book.ranking') }}" class="text-grey fs-24">
                                more <span class="h4"><i class="fa-solid fa-chevron-right"></i><i
                                        class="fa-solid fa-chevron-right"></i></span>
                            </a>
                        </p>
                    </div>
                </div>
                {{-- Booklist --}}
                <div id="carouselRankingControls" class="carousel slide mt-2">
                    <div class="carousel-inner">
                        @foreach ($rankedBooks->chunk(4) as $chunk)
                            <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                                <div class="row">
                                    @foreach ($chunk as $book)
                                        <div class="col-3">

                                            @if ($loop->iteration <= 3)
                                                <div class="h1">
                                                    {{-- star color --}}
                                                    @if ($loop->iteration == 1)
                                                        <i class="fa-solid fa-crown" style="color: gold"></i>
                                                        {{ $loop->iteration }}
                                                    @elseif ($loop->iteration == 2)
                                                        <i class="fa-solid fa-crown" style="color: silver"></i>
                                                        {{ $loop->iteration }}
                                                    @elseif ($loop->iteration == 3)
                                                        <i class="fa-solid fa-crown" style="color: #9A6229"></i>
                                                        {{ $loop->iteration }}
                                                    @endif
                                                </div>
                                            @else
                                                <div class="h1">
                                                    <i class="fa-solid fa-star text-white"></i>
                                                    {{ $loop->iteration }}
                                                </div>
                                            @endif
                                            <div class="text-center">
                                                <a href="{{ route('book.show_book', $book->id) }}">
                                                    <img src="{{ asset('images/649634.png') }}" class="w-75 shadow img-list"
                                                        alt="Image {{ $loop->iteration }}">
                                                </a>
                                                <p class="mt-4">
                                                    <a href="{{ route('book.show_book', $book->id) }}"
                                                        class="text-decoration-none text-primary fs-24 fw-bold">
                                                        {{$book->title}}
                                                    </a>
                                                </p>
                                                <p>
                                                    <a href="#" class="text-decoration-none h4 fw-bold">
                                                        Author
                                                    </a>
                                                </p>
                                            </div>
                                        </div>
                                    @endforeach

                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="align-items-center">
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselRankingControls"
                            data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                    </div>
                    <div class="align-items-center">
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselRankingControls"
                            data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>


                </div>



            </div>
            {{-- Suggestion --}}
            <div class="bg-white rounded px-5 py-2 shadow my-5 list-board">
                <div class="row">
                    <div class="col">
                        <h2 class="h1 fw-bold text-grey mt-3">Suggestion</h2>
                    </div>
                    <div class="col text-end ">
                        <p class="text-end mt-3 mb-0">
                            <a href="{{ route('book.suggestion') }}" class="text-grey fs-24">
                                more <span class="h4"><i class="fa-solid fa-chevron-right"></i><i
                                        class="fa-solid fa-chevron-right"></i></span>
                            </a>
                        </p>
                    </div>
                </div>
                {{-- Booklist --}}
                <div id="carouselSuggestionControls" class="carousel slide mt-2" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        @foreach ($suggestionedBooks->chunk(4) as $chunk)
                            <div class="carousel-item active">
                                <div class="row">
                                    @foreach ($chunk as $book)
                                        <div class="col-3">
                                            <div class="h1">
                                                <i class="fa-solid fa-star text-white"></i>{{ $loop->iteration }}
                                            </div>
                                            <div class="text-center">
                                                <a href="{{ route('book.show_book', $book->id) }}">
                                                    <img src="{{$book->image}}" class="w-75 shadow img-list"
                                                        alt="Image {{ $loop->iteration }}">
                                                </a>
                                                <p class="mt-4">
                                                    <a href="{{ route('book.show_book', $book->id) }}"
                                                        class="text-decoration-none text-primary fs-24 fw-bold">
                                                        {{$book->title}}</a>
                                                </p>

                                                <p>
                                                    <a href="#" class="text-decoration-none h4 fw-bold">
                                                        Author
                                                    </a>
                                                </p>
                                            </div>

                                        </div>
                                    @endforeach

                                </div>
                            </div>
                        @endforeach
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
            <div class="bg-white rounded px-5 py-2 shadow my-5 list-board">
                <div class="row">
                    <div class="col">
                        <h2 class="h1 fw-bold text-grey mt-3">New</h2>
                    </div>
                    <div class="col text-end ">

                        <p class="text-end mt-3 mb-0">
                            <a href="{{ route('book.new') }}" class="text-grey fs-24">
                                more <span class="h4"><i class="fa-solid fa-chevron-right"></i><i
                                        class="fa-solid fa-chevron-right"></i></span>
                            </a>
                        </p>

                    </div>
                </div>
                {{-- Booklist --}}
                <div id="carouselNewControls" class="carousel slide mt-2" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        @foreach ($newedBooks->chunk(4) as $chunk)
                            <div class="carousel-item active">
                                <div class="row">
                                    @foreach ($chunk as $book)
                                        <div class="col-3">
                                            <div class="h1">
                                                <i class="fa-solid fa-star text-white"></i>{{ $loop->iteration }}
                                            </div>
                                            <div class="text-center">
                                                <a href="{{ route('book.show_book', $book->id) }}">
                                                    <img src="{{ asset('images/649634.png') }}" class="w-75 shadow img-list"
                                                        alt="Image {{ $loop->iteration }}">
                                                </a>
                                                <p class="mt-4">
                                                    <a href="{{ route('book.show_book', $book->id) }}"
                                                        class="text-decoration-none text-primary fs-24 fw-bold">
                                                        {{$book->title}}
                                                    </a>
                                                </p>
                                                <p>
                                                    <a href="#" class="text-decoration-none h4 fw-bold">
                                                        Author
                                                    </a>
                                                </p>

                                            </div>

                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach

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
        <div class="col-3  bg-grey ">
            {{-- New thread list --}}
            <div class="row justify-content-center">
                <div class="col-11 bg-white rounded shadow mt-5">

                    <h3 class="fw-bold mt-3 mb-1">
                        <a href="{{ route('thread.home') }}" class="text-decoration-none text-grey">New Thread</a>
                    </h3>

                    @foreach ($threads as $thread)
                            <div class="mt-2 h3">
                                <a href="{{route('thread.content',$thread)}}" class="text-decoration-none">{{$thread->title}}</a>
                            </div>
                    @endforeach

                    <p class="text-end">
                        <a href="{{ route('thread.home') }}" class="text-grey fs-24">
                            more <span class="h4"><i class="fa-solid fa-chevron-right"></i><i
                                    class="fa-solid fa-chevron-right"></i></span>
                        </a>
                    </p>

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
