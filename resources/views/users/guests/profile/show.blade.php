@extends('layouts.app')

@section('title', 'Guest Review')


@section('content')

    @include('users.guests.profile.contents.header')

    <div class="row justify-content-center mt-2">
        <div class="col-8 mt-3">
            <div class="p-4 d-flex justify-content-around">
                <a href="{{ route('profile.show', $user->id) }}"
                    class="fw-bold text-decoration-none fs-40 text-dark">Review</a>
                @if (Auth::id() == $user->id || Auth::user()->role_id == 1)
                    <a href="{{ route('profile.bookmark', $user->id) }}"
                        class="fw-bold text-decoration-none fs-40 text-grey">Bookmark</a>
                    <a href="{{ route('profile.order', $user->id) }}"
                        class="fw-bold text-decoration-none fs-40 text-grey">Order</a>
                    <a href="{{ route('profile.comment', $user->id) }}"
                        class="fw-bold text-decoration-none fs-40 text-grey">Comment</a>
                @endif
            </div>
            <div class="bg-white rounded mt-2 px-5 overflow-auto profile-list shadow">
                <h2 class="h1 fw-bold text-grey mt-3">Review</h2>

                @if ($user->reviews->isEmpty())

                    <div class="d-flex align-items-center justify-content-center" style="height: 400px;">
                        <p class="text-center h1">No data yet</p>
                    </div>
                @else
                    @foreach ($user->reviews as $review)
                        @if ($review->book)
                            <div class="row mt-4">
                                <p class="text-muted mb-0">{{ $review->created_at }}</p>

                                <div class="col-lg-3">
                                    <a href="{{ route('book.show_book', $review->book->id) }}" class="text-decoration-none">
                                        <img src="{{ $review->book->image }}" alt="{{ $review->book->id }}"
                                            class="bookcover img-fluid  shadow">
                                    </a>
                                    <a href="{{ route('book.show_book', $review->book->id) }}" class="text-decoration-none">
                                        <p class="h4 mt-2">{{ $review->book->title }}</p>
                                    </a>
                                </div>
                                <div class="col-lg-9 fs-32">
                                    <p>
                                        @php
                                            $fullStars = floor($review->star_count); // 満点の数
                                            $halfStar = $review->star_count - $fullStars >= 0.1; // 半点があるか
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
                                        {{ $review->title }}
                                    </p>
                                    <p class="h4 wrap-text">{{ $review->body }}</p>
                                </div>

                            </div>
                            <hr>
                        @endif
                    @endforeach
                @endif


            </div>
        </div>


    </div>




@endsection
