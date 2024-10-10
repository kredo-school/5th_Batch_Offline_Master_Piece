@extends('layouts.app')

@section('title', 'Guest Bookmark')


@section('content')

    @include('users.guests.profile.contents.header')

    <div class="row justify-content-center mt-2">
        <div class="col-8 mt-3">
            <div class="p-4 d-flex justify-content-around">
                <a href="{{ route('profile.show', $user->id) }}"
                    class="fw-bold text-decoration-none fs-40 text-grey">Review</a>
                <a href="{{ route('profile.bookmark', $user->id) }}"
                    class="fw-bold text-decoration-none fs-40 text-dark">Bookmark</a>
                <a href="{{ route('profile.order', $user->id) }}"
                    class="fw-bold text-decoration-none fs-40 text-grey">Order</a>
                <a href="{{ route('profile.comment', $user->id) }}"
                    class="fw-bold text-decoration-none fs-40 text-grey">Comment</a>

            </div>
            <div class="bg-white rounded mt-2 px-5 overflow-auto profile-list">
                <h2 class="h1 fw-bold text-grey mt-3">Bookmark</h2>
                @foreach ($user->bookmarks as $bookmark)
                    <div class="row mt-4">
                        <div class="col-3">
                            <a href="{{ route('book.show_book') }}" class="text-decoration-none">
                                <img src="{{ $bookmark->book }}" alt="{{ $bookmark->book->id }}" class="w-100 shadow">
                            </a>
                        </div>
                        <div class="col-6 fs-32">
                            <p>
                                <a href="{{ route('book.show_book') }}" class="text-decoration-none">
                                    <p class="fs-32">{{ $bookmark->book->name }}</p>
                                </a>
                                <a href="{{ route('book.author_show') }}" class="text-decoration-none  text-dark">
                                    <p class="h4">$book->author->name
                                </a>
                            </p>
                            @php
                                $averageStarCount = $bookmark->book->reviews->avg('star_count');
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
                            <p class="text-danger fs-32 mt-5">¥ {{ floor($bookmark->book->price) }}</p>
                        </div>
                        <div class="col-3">
                            <div class="h-75 text-end">
                                @if ($bookmark->book->isBookmarked())
                                    <form action="{{ route('bookmark.destroy', $bookmark->book->id) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn p-0">
                                            <i class="fa-solid fa-bookmark text-warning h1"></i>
                                        </button>
                                    </form>
                                @else
                                    <form action="{{ route('bookmark.store', $bookmark->book->id) }}" method="post">
                                        @csrf
                                        <button type="submit" class="btn p-0">
                                            <i class="fa-regular fa-bookmark text-warning h1"></i>
                                        </button>
                                    </form>
                                @endif

                            </div>
                            <div class="h-25 pt-3">
                                <a href="{{ route('book.store_list') }}" class="btn btn-orange bottom-0 w-100">Select
                                    Store</a>
                            </div>


                        </div>



                    </div>
                    <hr>
                @endforeach
            </div>
        </div>


    </div>




@endsection
