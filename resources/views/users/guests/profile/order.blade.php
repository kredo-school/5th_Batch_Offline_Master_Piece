@extends('layouts.app')

@section('title', 'Guest Order')


@section('content')

    @include('users.guests.profile.contents.header')

    <div class="row justify-content-center mt-2">
        <div class="col-8 mt-3">
            <div class="p-4 d-flex justify-content-around">
                <a href="{{ route('profile.show', $user->id) }}"
                    class="fw-bold text-decoration-none fs-40 text-grey">Review</a>
                @if(Auth::id() == $user->id || Auth::user()->role_id == 1)
                    <a href="{{ route('profile.bookmark', $user->id) }}"
                        class="fw-bold text-decoration-none fs-40 text-grey">Bookmark</a>
                    <a href="{{ route('profile.order', $user->id) }}"
                        class="fw-bold text-decoration-none fs-40 text-dark">Order</a>
                    <a href="{{ route('profile.comment', $user->id) }}"
                        class="fw-bold text-decoration-none fs-40 text-grey">Comment</a>
                @endif
            </div>
            <div class="bg-white rounded mt-2 px-5 overflow-auto profile-list">
                <h2 class="h1 fw-bold text-grey mt-3">Order</h2>
                @if ($user->histories->isEmpty())

                <div class="d-flex align-items-center justify-content-center" style="height: 400px;">
                    <p class="text-center h1">No data yet</p>
                </div>
                @else

                @foreach ($user->histories as $history)
                    <div class="row mt-4">
                        <div class="col-lg-4 text-center">
                            <p class="text-muted">{{ $history->created_at }}</p>
                            <a href="{{ route('book.show_book', $history->book->id) }}" class="text-decoration-none">
                                <img src="{{ $history->book->image }}" alt="{{ $history->book->id }}"
                                    class="bookcover img-fluid shadow">
                            </a>
                        </div>
                        <div class="col-lg-8 row fs-32">
                            <div class="col">
                                <a href="{{ route('book.show_book', $history->book->id) }}"
                                    class="text-decoration-none">
                                    <p class="fs-32 mb-0">{{ $history->book->title }}</p>
                                </a>                  
                            </div>
                            <div class="col text-end">
                                @if ($history->book->isBookmarked())
                                <form action="{{ route('bookmark.destroy', $history->book->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn p-0">
                                        <i class="fa-solid fa-bookmark text-warning h1"></i>
                                    </button>
                                </form>
                            @else
                                <form action="{{ route('bookmark.store', $history->book->id) }}" method="post">
                                    @csrf
                                    <button type="submit" class="btn p-0">
                                        <i class="fa-regular fa-bookmark text-warning h1"></i>
                                    </button>
                                </form>
                            @endif
                            </div>
                            <p>
                                @foreach ($history->book->authors as $author)
                                    <a href="{{ route('book.author_show', $author->id) }}"
                                        class="text-decoration-none  text-dark">
                                        <p class="h4">{{ $author->name }}</p>
                                    </a>
                                @endforeach
                            </p>
                            <div >
                                @php
                                    $averageStarCount = $history->book->reviews->avg('star_count');
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

                            </div>
                            <div class="col-6 text-danger fs-32 mt-2">
                                ¥ {{ floor($history->book->price) }}
                            </div>
                            <div class="col-6 h-25 pt-3 text-end">
                                <a href="{{ route('book.inventory', $history->book->id) }}"
                                    class="btn btn-orange bottom-0 p-2 mb-2">Select
                                    Store</a>
                            </div>
                        </div>



                    </div>
                    <hr>
                @endforeach

                @endif


            </div>
        </div>


    </div>




@endsection
