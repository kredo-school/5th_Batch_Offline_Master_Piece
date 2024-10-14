@extends('layouts.app')

@section('title', 'Store Search')

@section('content')
    <a href="{{ url()->previous() }}" class="fw-bold text-decoration-none main-text btn border-0">
        <div class="h2 fw-semibold">
            <i class="fa-solid fa-caret-left"></i>
            <div class="d-inline main-text">Back</div>
        </div>
    </a>

    <div class="container">
        <div class="d-flex justify-content-center" >
            <form action="{{ route('store.books.search') }}" class="d-flex">
                @csrf
                <div class="row ms-auto">
                    <div class="col pe-0 position-relative">
                        <input type="text" id="searchInput" name="search" class="form-control rounded"
                            style="width: 400px" placeholder="Search books...">
                        <span id="clearButton" class="clearButton" >&times;</span>
                        <script>
                            // 正しいIDを取得
                            const searchInput = document.getElementById('searchInput');
                            const clearBtn = document.getElementById('clearButton');

                            // 入力フィールドのイベントリスナーを設定
                            searchInput.addEventListener('input', function() {
                                if (searchInput.value.length > 0) {
                                    clearBtn.style.display = 'inline';  // テキストがあるときはバツ印を表示
                                } else {
                                    clearBtn.style.display = 'none';    // テキストがないときは非表示
                                }
                            });

                            // バツ印をクリックしたときの処理
                            clearBtn.addEventListener('click', function() {
                                searchInput.value = '';  // 入力フィールドをクリア
                                clearBtn.style.display = 'none';  // バツ印を非表示
                                searchInput.focus();  // フィールドにフォーカスを戻す
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
        @if ($books->isEmpty())
            <div class="mt-5 fw-bold text-center"><h4>No books found.</h4></div>
        @else
            <div class="mt-4 h5" style="margin-left: 5%;">Search results: <span class="fw-bold">{{ $bookCount }}</span> books found.</div>

            <div class="d-flex justify-content-center align-items-center m-auto" style="width: 90%;">
                <table class="book-information-table table table-striped text-center shadow mb-5">
                    <thead>
                        <th style="width: 5%;">No.</th>
                        <th style="width: 10%;">Image</th>
                        <th style="width: 15%;">Title</th>
                        <th style="width: 15%;">Author</th>
                        <th style="width: 15%;">Publisher</th>
                        <th style="width: 15%;">Publication Date</th>
                        <th style="width: 10%;">Price</th>
                        <th style="width: 15%;">ISBN</th>
                    </thead>
                    <tbody>
                        @foreach ($books as $book)
                            <tr onclick="window.location='{{ route('store.bookInformation', $book->id) }}';" style="cursor: pointer;">
                                <td style="width: 5%;">{{ $loop->iteration }}</td>
                                <td style="width: 10%;">
                                    <img src={{ $book->image }} style="width: 50px;">
                                </td>
                                <td style="width: 15%;">{!! highlightKeyword($book->title, $searchQuery) !!}</td>
                                <td style="width: 15%;">
                                    @foreach ($book->authors_books as $authors_books)
                                        {!! highlightKeyword($authors_books->author->name, $searchQuery) !!}
                                    @endforeach
                                </td>
                                <td style="width: 15%;">{!! highlightKeyword($book->publisher, $searchQuery) !!}</td>
                                <td style="width: 15%;">{!! highlightKeyword($book->publication_date, $searchQuery) !!}</td>
                                <td style="width: 10%;">{!! highlightKeyword($book->price, $searchQuery) !!}</td>
                                <td style="width: 15%;">{!! highlightKeyword($book->isbn_code, $searchQuery) !!}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>

    <style>
        .book-information-table {
            width: 100%;
            table-layout: fixed;"
        }
        .book-information-table thead {
            display: table;
            width: 100%;
            background-color: #D3DD53;
        }

        .book-information-table td {
            vertical-align: middle;
            background-color: white;
            font-size: 1rem;
        }

        .book-information-table th {
            background-color: #D3DD53;
            color: white;
        }

        .book-information-table tbody {
            display: block;
            max-height: 612px;
            overflow-y: scroll;
            width: 100%;"
        }

        .book-information-table tr{
            display: table;
            width: 100%;
            table-layout: fixed;"
        }
    </style>

@endsection
