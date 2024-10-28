@extends('layouts.app')

@section('title', 'Book Information')

@section('content')
    <a href="{{ url()->previous() }}" class="fw-bold text-decoration-none main-text btn border-0">
        <div class="h2 fw-semibold">
            <i class="fa-solid fa-caret-left"></i>
            <div class="d-inline main-text">Back</div>
        </div>
    </a>


    <div class="container">
        <div class="d-flex justify-content-center">
            <form action="{{ route('store.books.search') }}" class="d-flex">
                @csrf
                <div class="row ms-auto">
                    <div class="col pe-0 position-relative">
                        <input type="text" id="searchInput" name="search" class="form-control rounded"
                            style="width: 400px" placeholder="Search books...">
                        <span id="clearButton" class="clearButton">&times;</span>
                        <script>
                            // 正しいIDを取得
                            const searchInput = document.getElementById('searchInput');
                            const clearBtn = document.getElementById('clearButton');

                            // 入力フィールドのイベントリスナーを設定
                            searchInput.addEventListener('input', function() {
                                if (searchInput.value.length > 0) {
                                    clearBtn.style.display = 'inline'; // テキストがあるときはバツ印を表示
                                } else {
                                    clearBtn.style.display = 'none'; // テキストがないときは非表示
                                }
                            });

                            // バツ印をクリックしたときの処理
                            clearBtn.addEventListener('click', function() {
                                searchInput.value = ''; // 入力フィールドをクリア
                                clearBtn.style.display = 'none'; // バツ印を非表示
                                searchInput.focus(); // フィールドにフォーカスを戻す
                            });
                        </script>
                    </div>
                    <div class="col ps-1">
                        <button type="submit" class="btn btn-warning search-icon">
                            <i class="fa-solid fa-magnifying-glass text-white"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const searchInput = document.getElementById('searchInput'); // クラスからIDに変更

                searchInput.addEventListener('focus', function() {
                    const rect = searchInput.getBoundingClientRect();
                    const offset = window.pageYOffset + rect.top;

                    window.scrollTo({
                        top: offset - 50,
                        behavior: 'smooth'
                    });
                });
            });
        </script>


        <div class="d-flex justify-content-center mt-5 w-75 mx-auto">
            <div class="bg-white shadow p-4" style="width: 100%; border-radius: 16px;">
                <div class="row">
                    <div class="col-4">
                        <a href="{{ route('book.show_book', $book->id) }}" class="show-bookimg">
                            <img src="{{ $book->image }}" alt="book image {{ $book->id }}" class="img-fluid">
                        </a>
                        <p class="h1 bold">Stock:
                            {{ $book->inventory->first() ? $book->inventory->first()->stock : 'No stock data' }}
                        </p>
                        <div class="row mt-1">
                            <form action="{{route('store.addOrUpdateOrders')}}" method="post">
                                @csrf
                                <input type="hidden" name="orders[0][book_id]" value="{{ $book->id }}">
                                <div class="row">
                                    <div class="col-4 text-end">
                                        <button type="button" class="btn text-danger btn-decrease"><i
                                                class="fa-solid fa-minus h3"></i></button>
                                    </div>
                                    <div class="col-4">
                                        <input type="number" name="orders[0][quantity]" id="quantityInput" class="form-control"
                                            value="{{old('orders[0][quantity]')}}" min="1">
                                    </div>
                                    <div class="col-4">
                                        <button type="button" class="btn text-primary btn-increase"><i
                                                class="fa-solid fa-plus h3"></i></button>
                                    </div>
                                </div>

                        </div>
                    </div>
                    <div class="col-8">

                        <h2 class="fw-bold d-flex">Title: {{ $book->title }}</h2>
                        <h4>Author: @foreach ($book->authors as $author)
                                <a href="{{ route('book.author_show', $author->id) }}"
                                    class="link-book">{{ $author->name }}</a>
                            @endforeach
                        </h4>
                        <h4>Publisher: {{ $book->publisher }}</h4>
                        <h4>Publish year: {{ $book->publication_date }}</h4>
                        <h4>Description: {{ $book->description }}</h4>
                        <h4 class="d-flex">Rate:
                            <!-- Button trigger modal -->
                            <button type="button" class="btn d-flex" data-bs-toggle="modal" data-bs-target="#reviewBook">
                                <div class="star-ration ms-2 fa-lg">
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
                            </button>
                        </h4>

                        @include('users.guests.book.modals.review_book')

                        <h4 class="d-flex">Price:<p class="text-danger mb-0 ms-3"> ¥ {{ floor($book->price) }}</p>
                        </h4>
                        <h4>Genre: @foreach ($book->genres as $genre)
                                {{ $genre->name }}
                            @endforeach
                        </h4>
                    </div>
                </div>
            </div>
        </div>

        @if (session('success'))
            <div class="alert alert-success text-center w-25 mx-auto mt-1">
                {{ session('success') }}
            </div>
        @endif
        <div class="d-flex justify-content-center mt-3">
            <button type="submit" class="order-button d-block text-decoration-none text-center border-0" style="width: 15%; border-radius: 16px;">
                Order <i class="fa-solid fa-caret-right"></i>
            </button>
        </div>
        </form>
        @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

    </div>


    <style>
        .table-header,
        .table-body {
            flex: 1;
            font-size: 18px;
        }

        .table-header table,
        .table-body table {
            border-collapse: collapse;
            width: 100%;
        }

        .table-header th,
        .table-body td {
            padding: 10px;
            text-align: left;
        }

        .table-body td {
            text-align: center;
        }

        .table {
            background-color: white;
        }

        table thead tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        table tbody tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .table-body a {
            color: black;
            text-decoration: none;
        }

        .order-button {
            height: 60px;
            background-color: #D3DD53;
            color: white;
            font-size: 1.5rem;
            font-weight: bold;
            padding: 12px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        .order-button:hover {
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.3);
        }

        .order-button:active {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transform: translateY(2px);
        }
    </style>

    <script>
        const stars = document.querySelectorAll(".star-btn"); // 星の要素を取得
        const ratingValue = document.getElementById("rating-value"); // hidden input
        const ratingValueNumber = document.getElementById("rating-value-number"); // 数値部分のみ

        let currentRating = -1; // 現在の評価を保持

        // 星にイベントを設定
        stars.forEach((star, index) => {
            star.addEventListener("mouseover", () => {
                highlightStars(index); // ハイライト更新
            });

            star.addEventListener("click", () => {
                currentRating = index; // 現在の評価を保存
                ratingValue.value = currentRating + 1; // hidden inputにセット
                ratingValueNumber.textContent = ratingValue.value; // 数値部分のみ更新
            });

            star.addEventListener("mouseout", () => {
                highlightStars(currentRating); // 選択済みの評価に戻す
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


        // ボタンを取得
        document.querySelector('.btn-increase').addEventListener('click', function() {
            let quantityInput = document.getElementById('quantityInput');
            let quantity = parseInt(quantityInput.value, 10) || 0;
            quantityInput.value = quantity + 1; // 増加
        });

        document.querySelector('.btn-decrease').addEventListener('click', function() {
            let quantityInput = document.getElementById('quantityInput');
            let quantity = parseInt(quantityInput.value, 10) || 1;
            if (quantity > 1) {
                quantityInput.value = quantity - 1; // 減少
            }
        });

        // バリデーションとアラート
        document.querySelector('.btn-primary').addEventListener('click', function(event) {
            let quantity = parseInt(document.getElementById('quantityInput').value, 10) || 0;
            if (quantity <= 0) {
                event.preventDefault();
                alert('Please enter a valid quantity.');
            }
        });
    </script>


@endsection
