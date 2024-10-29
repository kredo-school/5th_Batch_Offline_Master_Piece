@extends('layouts.app')

@section('title', 'Show Store')

@section('content')
    {{-- Back button --}}
    <div>
        <a href="{{ url()->previous() }}" class="fw-bold text-decoration-none main-text btn border-0">
            <div class="h2 fw-semibold">
                <i class="fa-solid fa-caret-left"></i>
                <div class="d-inline main-text">Back</div>
            </div>
        </a>
    </div>


    <form action="{{route('book.searchAuthor')}}" method="get">
        <div class="row justify-content-center mb-5">
            <div class="col-5">
                <form action="#" style="width: 500px" class="d-flex">
                    @csrf
                    <div class="row ms-auto">
                        <div class="col pe-0 position-relative">
                            <input type="text" id="searchInput" name="search" class="form-control rounded searchInput"
                                style="width: 400px" placeholder="Search authors...">
                            <span id="clearButton" class="clearButton">&times;</span>
                        </div>
                        <div class="col ps-1">
                            <button type="submit" class="btn btn-secondary">
                                Search
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </form>

    <div class="container-body p-5" style="overflow-y: auto; height: 650px;">
        <div class="ms-3">
            <h2 class="h1 fw-bold text-grey mt-3">{{ $author->name }}</h2>

            @foreach ($author->books as $book)
                <div class="row mt-5">
                    <div class="col-3">
                        <a href="{{ route('book.show_book', $book->id) }}">
                            <img src="{{ $book->image }}" alt="{{ $book->id }}" class="w-100 shadow">
                        </a>
                    </div>
                    <div class="col-6 fs-32">
                        <p>
                            <a href="{{ route('book.show_book', $book->id) }}" class="link-book">
                                <p class="fs-32">{{ $book->title }}</p>
                            </a>
                        <p class="h4">{{ $author->name }}</p>

                        @php
                            $averageStarCount = $book->reviews->avg('star_count');
                            $fullStars = floor($averageStarCount); // 満点の数
                            $halfStar = $averageStarCount - $fullStars >= 0.1; // 半点があるか
                            $emptyStars = 5 - $fullStars - ($halfStar ? 1 : 0); // 残りの星
                        @endphp

                        {{-- 満点の星を表示 --}}
                        @for ($i = 0; $i < $fullStars; $i++)
                            <i class="fa-solid fa-star text-warning"></i>
                        @endfor

                        {{-- 半点の星を表示 --}}
                        @if ($halfStar)
                            <i class="fa-solid fa-star-half-stroke text-warning"></i>
                        @endif

                        {{-- 未満の星を表示 --}}
                        @for ($i = 0; $i < $emptyStars; $i++)
                            <i class="fa-regular fa-star text-warning"></i>
                        @endfor

                        {{ number_format($averageStarCount, 1) }}/5.0
                        <p class="text-danger fs-32 mt-5">¥ {{ floor($book->price) }}</p>
                    </div>
                    <div class="col-3">
                        <div class="h-75 text-end">
                            @if ($book->isBookmarked())
                                <form action="{{ route('bookmark.destroy', $book->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn p-0">
                                        <i class="fa-solid fa-bookmark text-warning h1"></i>
                                    </button>
                                </form>
                            @else
                                <form action="{{ route('bookmark.store', $book->id) }}" method="post">
                                    @csrf
                                    <button type="submit" class="btn p-0">
                                        <i class="fa-regular fa-bookmark text-warning h1"></i>
                                    </button>
                                </form>
                            @endif

                        </div>
                        <div class="h-25 pt-3">
                            <a href="{{ route('book.inventory',$book->id) }}" class="btn btn-orange bottom-0 w-100">Select
                                Store</a>
                        </div>


                    </div>
                </div>
                <hr>
            @endforeach


        </div>
    </div>

@endsection
