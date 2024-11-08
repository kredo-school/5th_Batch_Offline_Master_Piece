@extends('layouts.app')

@section('title', 'search-list')

@section('content')
    <div class="row justify-content-center">
        <div class="col-8 mt-1">
            <div class="bg-white rounded my-5 px-5 overflow-auto profile-list">
                <h2 class="h1 fw-bold text-grey mt-3">Search results:
                    {{ request()->has('search') && !empty(request()->input('search')) ? request()->input('search') : 'All' }}
                </h2><br>

                @if ($books->isNotEmpty())
                    @foreach ($books as $book)
                        <div class="row mt-4">
                            <p class="text-muted">{{ $book->created_at }}</p>
                            <div class="col-3">
                                <a href="{{ route('book.show_book', $book->id) }}" class="text-decoration-none">
                                    <img src="{{ $book->image }}" alt="{{ $book->id }}" class="w-100 shadow">
                                </a>
                            </div>
                            <div class="col-6 fs-32">
                                <p class="h2">
                                    <a href="{{ route('book.show_book', $book->id) }}" class="text-decoration-none text-black">
                                        {{ $book->title }}
                                    </a>
                                </p>

                                @foreach ($book->authors as $author)
                                    <p class="h4">
                                        <a href="{{ route('book.author_show', $author->id) }}" class="text-decoration-none text-black">
                                            {{ $author->name }}
                                        </a>
                                    </p>
                                @endforeach

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
                                    <a href="{{ route('book.inventory', $book->id) }}" class="btn btn-orange bottom-0 w-100">Select
                                        Store</a>
                                </div>


                            </div>



                        </div>
                        <hr>
                    @endforeach
                @else
                    <div class="text-center mt-5 ">
                        <h2 class="text-grey display-4">Book not found</h2>
                    </div>
                @endif


            </div>
        </div>
    </div>




@endsection
