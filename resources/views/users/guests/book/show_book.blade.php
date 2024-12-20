@extends('layouts.app')

@section('title', 'Show Book')

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


    <div class="container-body">
        <div class="row">
            <div class="col-md-4">
                <a href="{{ route('book.show_book', $book->id) }}" class="show-bookimg">
                    <img src="{{ $book->image }}" alt="book image {{ $book->id }}" class="img-fluid">
                </a>
            </div>
                <div class="col-md-8">
                <div class="row">
                    <div class="col-10">
                        <h1 class="fw-bold">Title: {{ $book->title }}</h1>
                    </div>
                    <div class="col-2 text-end">
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
                </div>
    
                <h3>Author: 
                    @foreach ($book->authors as $author)
                        <a href="{{ route('book.author_show', $author->id) }}" class="link-book">{{ $author->name }}</a>
                    @endforeach
                </h3>
                <h3>Publisher: {{ $book->publisher }}</h3>
                <h3>Publish year: {{ $book->publication_date }}</h3>
                <h3>Description: {{ $book->description }}</h3>
    
                <h3 class="d-flex">Rate:
                    <button type="button" class="btn d-flex" data-bs-toggle="modal" data-bs-target="#reviewBook">
                        <div class="star-ration ms-2 fa-lg">
                            @php
                                $averageStarCount = $book->reviews->avg('star_count');
                                $fullStars = floor($averageStarCount);
                                $halfStar = $averageStarCount - $fullStars >= 0.1;
                                $emptyStars = 5 - $fullStars - ($halfStar ? 1 : 0);
                                $reviewCount = $book->reviews->count();
                            @endphp
                            @for ($i = 0; $i < $fullStars; $i++)
                                <i class="fa-solid fa-star text-warning"></i>
                            @endfor
                            @if ($halfStar)
                                <i class="fa-solid fa-star-half-stroke text-warning"></i>
                            @endif
                            @for ($i = 0; $i < $emptyStars; $i++)
                                <i class="fa-regular fa-star text-warning"></i>
                            @endfor
                            {{ number_format($averageStarCount, 1) }}/5.0
                        </div>
                        <p class="ms-2 h5">({{ $reviewCount }})</p>
                    </button>
                </h3>
    
                @include('users.guests.book.modals.review_book')
    
                <h3 class="d-flex">Price: <div class="text-danger">¥ {{ floor($book->price) }}</div></h3>
                <h3>Genre: 
                    @foreach ($book->genres as $genre)
                        {{ $genre->name }}
                    @endforeach
                </h3>
                <form action="{{ route('book.inventory', $book->id) }}" method="get">
                    @csrf
                    <div class="row align-items-center">
                        <div class="col-md-6 mb-2">
                            <select name="address" class="form-select">
                                <option value="All Area" {{ $selectedPrefecture == 'All Area' ? 'selected' : '' }}>All Area</option>
                                @foreach ($prefectures as $prefecture)
                                    <option value="{{ $prefecture }}" {{ $selectedPrefecture == $prefecture ? 'selected' : '' }}>
                                        {{ $prefecture }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <button type="submit" class="btn btn-orange w-100">Select Store</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    

    {{-- Review List --}}
    <div class="container-body review-list">
        <div class="d-flex align-items-center">
            <div class="row w-100 d-flex">
                <div class="col-md-9">
                    <h2 class="main-text fw-bold">Review</h2>
                </div>
                <div class="col-md-3">
                    <form action="{{ route('book.show_book', $book->id) }}" method="get">
                        <select name="sort" id="sort" class="form-select w-100" onchange="this.form.submit()">
                            <option value=""hidden>sort</option>
                            <option value="latest-arrives" {{ request('sort') == 'latest-arrives' ? 'selected' : '' }}>
                                Latest-arrives</option>
                            <option value="highest-rating" {{ request('sort') == 'highest-rating' ? 'selected' : '' }}>
                                Highest Rating</option>
                            <option value="lowest-rating" {{ request('sort') == 'lowest-rating' ? 'selected' : '' }}>Lowest
                                Rating</option>
                            <option value="most-good-buttons" {{ request('sort') == 'most-good-buttons' ? 'selected' : '' }}>
                                most good buttons
                            </option>
                        </select>
                    </form>
                </div>
                {{-- sortを選択したときにTopに毎回戻らないようにする --}}
                <script>
                    window.onload = function() {
                        const scrollY = sessionStorage.getItem('scrollPosition');
                        if (scrollY) {
                            window.scrollTo(0, parseInt(scrollY, 10));
                        }
                    };

                    // スクロール位置を保存
                    window.onbeforeunload = function() {
                        sessionStorage.setItem('scrollPosition', window.scrollY);
                    };
                </script>
            </div>
        </div>
        <div style="overflow-y: auto; height: 650px;">
            @if ($reviews && $reviews->isNotEmpty())
                @foreach ($reviews as $review)
                    <div class="row mt-4">
                        @if ($review->user)
                            <a href="{{ route('profile.show', $review->user->id) }}"
                                class="text-decoration-none text-dark">
                                <div class="text-center d-flex align-items-center">
                                    @if (optional($review->user->profile)->avatar)
                                        <img src="{{ optional($review->user->profile)->avatar }}"
                                            alt="{{ $review->user->id }}"
                                            class="rounded-circle shadow p-1 review-avatar d-block ">
                                    @else
                                        <i class="fa-solid fa-circle-user p-1 text-secondary review-avatar-img"></i>
                                    @endif
                                    <p class="fs-32 ms-3 my-auto">{{ $review->user->name }}</p>
                                </div>
                            </a>
                        @endif
                    </div>
                    <div class="row my-auto d-flex">
                        <div class="col-md-4 fs-24">
                            @php
                                $fullStars = floor($review->star_count);
                                $halfStar = $review->star_count - $fullStars >= 0.1;
                                $emptyStars = 5 - $fullStars - ($halfStar ? 1 : 0);
                            @endphp

                            @for ($i = 0; $i < $fullStars; $i++)
                                <i class="fa-solid fa-star text-warning"></i>
                            @endfor

                            @if ($halfStar)
                                <i class="fa-solid fa-star-half-stroke text-warning"></i>
                            @endif

                            @for ($i = 0; $i < $emptyStars; $i++)
                                <i class="fa-regular fa-star text-warning"></i>
                            @endfor
                        </div>
                        <div class="col-md-8 fw-bold fs-24 d-flex">
                            <div class="col-md-11">
                                {{ $review->title }}
                            </div>
                            <div class="col-md-1 ms-2">
                                <form action="{{ route('book.review_delete', $review->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    @if (Auth::check() && Auth::id() === $review->user->id)
                                        <button class="text-danger border-0 bg-white fs-32"><i
                                                class="fa-regular fa-trash-can"></i></button>
                                    @endif
                                </form>
                            </div>
                        </div>
                    </div>
                    <p class="text-muted mb-0">{{ $review->created_at }}</p>
                    <div class="row">
                        <div class="col-10">
                            <p class="h4 wrap-text mt-3">{{ $review->body }}</p>
                        </div>
                        <div class="col-2">
                            <div class="text-end d-flex">
                                @if ($review->isLiked())
                                    <form action="{{ route('book.like.destroy', $review->id) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn  shadow-none p-0">
                                            <i class="fa-solid fa-thumbs-up fs-32"></i>
                                        </button>
                                    </form>
                                @else
                                    <form action="{{ route('book.like.store', $review->id) }}" method="post">
                                        @csrf
                                        <button type="submit" class="btn shadow-none p-0">
                                            <i class="fa-regular fa-thumbs-up fs-32"></i>
                                        </button>
                                    </form>
                                @endif
                                <span class="fs-32 ms-2 mt-0">{{ $review->likes->count() }}</span>
                            </div>
                        </div>
                    </div>
                    <hr>
                @endforeach
            @else
                <h3 class="text-center mt-5">No reviews available.</h3>

            @endif

        </div>

        {{-- Review Form --}}
        <form action="{{ route('book.review', $book->id) }}" method="post">
            @csrf
            <div class="review-list">
                <label for="write-review" class="form-label fw-bold fs-32 mt-3">Write your review</label>
                <div class="border border-1 border-black p-3">
                    <div class="row">
                        <h6 class="col-md-1">Rate:</h6>
                            <h6 class="star-rating ms-3 col-3">
                                <span class="star-btn" data-value="1"><i class="fa-regular fa-star"></i></span>
                                <span class="star-btn" data-value="2"><i class="fa-regular fa-star"></i></span>
                                <span class="star-btn" data-value="3"><i class="fa-regular fa-star"></i></span>
                                <span class="star-btn" data-value="4"><i class="fa-regular fa-star"></i></span>
                                <span class="star-btn" data-value="5"><i class="fa-regular fa-star"></i></span>
                            </h6>
                            <input type="hidden" name="star-rating" id="star-rating" value="">
                            <h6 class="ms-3 my-auto rating-value-number col-md-2">
                                <span id="rating-value-number">0</span> /5.0
                            </h6>
                            <div class="col-md-6"></div>
                            @error('star-rating')
                                <p class="text-danger small ms-3 my-auto">{{ $message }}</p>
                            @enderror
                        </h6>
                    </div>
                    <textarea name="review_title" id="review_title" rows="1" class="form-control border-0 review-wide"
                        placeholder="Title:"></textarea>
                    @error('review_title')
                        <p class="text-danger small">{{ $message }}</p>
                    @enderror
                    <hr>
                    <textarea name="review_content" id="review_content" rows="4" class="form-control border-0 review-wide"
                        placeholder="Content:"></textarea>
                    @error('review_content')
                        <p class="text-danger small">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="review-list text-end">
                <input type="submit" value="Post Review" class="btn mt-3 btn-orange px-5">
            </div>
        </form>

        <script>
            const stars = document.querySelectorAll(".star-btn"); // 星の要素を取得
            const ratingValue = document.getElementById("star-rating"); // hidden input
            const ratingValueNumber = document.getElementById("rating-value-number"); // 数値部分のみ

            let currentRating = 0; // 現在の評価を保持

            // 星にイベントを設定
            stars.forEach((star, index) => {
                star.addEventListener("mouseover", () => {
                    highlightStars(index); // ハイライト更新
                });

                star.addEventListener("click", () => {
                    currentRating = index + 1; // 現在の評価を保存（1から始まる）
                    ratingValue.value = currentRating; // hidden inputにセット
                    ratingValueNumber.textContent = ratingValue.value; // 数値部分のみ更新
                });

                star.addEventListener("mouseout", () => {
                    highlightStars(currentRating - 1); // 選択済みの評価に戻す
                });
            });

            // 星をハイライトする関数
            function highlightStars(index) {
                stars.forEach((star, i) => {
                    const icon = star.querySelector('i'); // 各<i>タグを取得
                    if (i <= index) {
                        icon.classList.remove("fa-regular");
                        icon.classList.add("fa-solid");
                    } else {
                        icon.classList.remove("fa-solid");
                        icon.classList.add("fa-regular");
                    }
                });
            }
        </script>

    </div>

    {{-- Suggestion --}}
    <div class="container-body">
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
                @foreach ($suggestedBooks->chunk(4) as $chunk)
                    <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                        <div class="row">
                            @foreach ($chunk as $book)
                                <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                                    <?php
                                    // ループの親ループのカウントを取得して、ページごとにカウントが進むように調整
                                    $overallIteration = ($loop->parent->iteration - 1) * 4 + $loop->iteration;
                                    ?>
                                    <div class="h1">
                                        <i class="fa-solid fa-star text-white"></i>{{ $overallIteration }}
                                    </div>
                                    <div class="text-center">
                                        <table class="mt-3">
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <a href="{{ route('book.show_book', $book->id) }}"
                                                            class="link-book">
                                                            <img src="{{ $book->image }}"
                                                                alt="book image {{ $book->id }}" class="img-fluid">
                                                        </a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <h4>
                                                            <a href="{{ route('book.show_book', $book->id) }}"
                                                                class="link-book">{{ $book->title }}</a>
                                                        </h4>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <h5>
                                                            @foreach ($book->authors as $author)
                                                                <a href="{{ route('book.author_show', $author->id) }}"
                                                                    class="link-book">{{ $author->name }}</a>
                                                            @endforeach
                                                        </h5>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="star-ration-list d-flex ms-5">
                                                        @php
                                                            $averageStarCount = $book->reviews->avg('star_count');
                                                            $fullStars = floor($averageStarCount); // 満点の数
                                                            $halfStar = $averageStarCount - $fullStars >= 0.1; // 半点があるか
                                                            $emptyStars = 5 - $fullStars - ($halfStar ? 1 : 0); // 残りの星
                                                            $reviewCount = $book->reviews->count();

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
                                                        @if ($reviewCount > 0)
                                                            <p class="ms-2">({{ $reviewCount }})</p>
                                                        @else
                                                            <p class="ms-2">(0)</p>
                                                        @endif
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <h4 class="text-danger">{{ $book->price }}</h4>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
            {{-- Indicators --}}
            <div class="carousel-indicators">
                @foreach ($suggestedBooks->chunk(4) as $chunk)
                    <button type="button" data-bs-target="#carouselRankingControls"
                        data-bs-slide-to="{{ $loop->index }}" class="{{ $loop->first ? 'active' : '' }}"
                        aria-current="true" aria-label="Slide {{ $loop->iteration }}"></button>
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
    <div class="container-body">
        <div class="row ms-2">
            <div class="col">
                <h2 class="h1 fw-bold text-grey mt-3">Same genre</h2>
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
        <div id="carouselSamegenres" class="carousel slide mt-2" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-inner">
                    @foreach ($sameGenreBooks->chunk(4) as $chunk)
                        <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                            <div class="row">
                                @foreach ($chunk as $book)
                                    <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                                        <?php
                                        // ループの親ループのカウントを取得して、ページごとにカウントが進むように調整
                                        $overallIteration = ($loop->parent->iteration - 1) * 4 + $loop->iteration;
                                        ?>
                                        <div class="h1">
                                            <i class="fa-solid fa-star text-white"></i>{{ $overallIteration }}
                                        </div>
                                        <div class="text-center">
                                            <table class="mt-3">
                                                <table class="mt-3">
                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <a href="{{ route('book.show_book', $book->id) }}"
                                                                    class="link-book">
                                                                    <img src="{{ $book->image }}"
                                                                        alt="book image {{ $book->id }}"
                                                                        class="img-fluid">
                                                                </a>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <h4>
                                                                    <a href="{{ route('book.show_book', $book->id) }}"
                                                                        class="link-book">{{ $book->title }}</a>
                                                                </h4>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <h5>
                                                                    @foreach ($book->authors as $author)
                                                                        <a href="{{ route('book.author_show', $author->id) }}"
                                                                            class="link-book">{{ $author->name }}</a>
                                                                    @endforeach
                                                                </h5>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="star-ration-list d-flex ms-5">
                                                                @php
                                                                    $averageStarCount = $book->reviews->avg(
                                                                        'star_count',
                                                                    );
                                                                    $fullStars = floor($averageStarCount); // 満点の数
                                                                    $halfStar = $averageStarCount - $fullStars >= 0.1; // 半点があるか
                                                                    $emptyStars = 5 - $fullStars - ($halfStar ? 1 : 0); // 残りの星
                                                                    $reviewCount = $book->reviews->count();

                                                                @endphp
                                                                {{-- 満点の星を表示 --}}
                                                                @for ($i = 0; $i < $fullStars; $i++)
                                                                    <i class="fa-solid fa-star text-warning"></i>
                                                                @endfor

                                                                {{-- 半点の星を表示 --}}
                                                                @if ($halfStar)
                                                                    <i
                                                                        class="fa-solid fa-star-half-stroke text-warning"></i>
                                                                @endif

                                                                {{-- 未満の星を表示 --}}
                                                                @for ($i = 0; $i < $emptyStars; $i++)
                                                                    <i class="fa-regular fa-star text-warning"></i>
                                                                @endfor

                                                                {{ number_format($averageStarCount, 1) }}/5.0
                                                                @if ($reviewCount > 0)
                                                                    <p class="ms-2">({{ $reviewCount }})</p>
                                                                @else
                                                                    <p class="ms-2">(0)</p>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <h4 class="text-danger">{{ $book->price }}</h4>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                        </div>

                                    </div>
                                @endforeach

                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            {{-- Indicators --}}
            <div class="carousel-indicators">
                @foreach ($sameGenreBooks->chunk(4) as $chunk)
                    <button type="button" data-bs-target="#carouselRankingControls"
                        data-bs-slide-to="{{ $loop->index }}" class="{{ $loop->first ? 'active' : '' }}"
                        aria-current="true" aria-label="Slide {{ $loop->iteration }}"></button>
                @endforeach
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselSamegenres"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselSamegenres"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
@endsection
