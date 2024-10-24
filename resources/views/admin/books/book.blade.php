@extends('layouts.app')

@section('content')
    <div>
        <a href="{{ url()->previous() }}" class="fw-bold text-decoration-none main-text btn border-0">
            <div class="h2 fw-semibold">
                <i class="fa-solid fa-caret-left"></i>
                <div class="d-inline main-text">Back</div>
            </div>
        </a>
    </div>
    <div class="upper-container">
        <div class="row align-items-center">
            <div class="col"></div>
            <div class="col-auto">
                <div class="row ms-3">
                    <div class="col">
                        <form action="{{ route('admin.books.search') }}" style="width: 500px" method="get"  class="d-flex">
                            @csrf
                            <div class="row ms-auto">
                                <div class="col pe-0 position-relative">
                                    <input type="text" id="searchInput" name="search" class="form-control form-control-sm rounded searchInput"
                                        style="width: 400px" placeholder="Search books by title, author, or genre" value="{{ request('search') }}">
                                    <span id="clearButton" class="clearButton">&times;</span>
                                </div>
                                <div class="col ps-1">
                                    <button type="submit" class="btn btn-warning search-icon btn-sm">
                                        <i class="fa-solid fa-magnifying-glass text-white"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-4">

                <form action="{{ route('admin.books.index') }}" method="GET" id="sortForm">
                    <div class="d-flex justify-content-center align-items-center">
                    <select class="form-select w-50 me-2" aria-label="admin-sort" id="manage-book-select" name="sort">
                        <option value="title" {{ request('sort') == 'title' ? 'selected' : '' }}>Title</option>
                        <option value="author" {{ request('sort') == 'author' ? 'selected' : '' }}>Author</option>
                        <option value="publisher" {{ request('sort') == 'publisher' ? 'selected' : '' }}>Publisher</option>
                        <option value="year" {{ request('sort') == 'year' ? 'selected' : '' }}>Publication date</option>
                        <option value="review" {{ request('sort') == 'review' ? 'selected' : '' }}>Review rate</option>
                        <option value="price" {{ request('sort') == 'price' ? 'selected' : '' }}>Price</option>
                        {{-- <option value="genre" {{ request('sort') == 'genre' ? 'selected' : '' }}>Genre</option> --}}
                        <option value="status" {{ request('sort') == 'status' ? 'selected' : '' }}>Status</option>
                    </select>
                    
                    <select class="form-select w-50 " aria-label="book-order" id="sort-order-select" name="order">
                        <option value="asc" {{ request('order') == 'asc' ? 'selected' : '' }}>↑ Ascending</option>
                        <option value="desc" {{ request('order') == 'desc' ? 'selected' : '' }}>↓ Descending</option>
                    </select>
                    </div>
                </form>
            </div>
        </div>
        @include('admin.button')
    </div>

    </div>
    {{-- 以下 --}}
    <div class="genre-container mt-4">
        <div class="row align-items-center">
            <div class="col-8"></div>
            <div class="col">
            </div>
            <div class="col-2">
                <a href="{{ route('admin.addBook') }}" class="btn btn-success" id="addBookBtn"><i
                        class="fa-solid fa-plus"></i> Add Book</a>
            </div>
        </div>
    </div>
    {{-- 間の追加オプション --}}


    <table class="table manage-table border-rounded " id="manage-book-table">
        <thead>
            <tr>
                <th>Title</th>
                <th>Author</th>
                <th>Publisher</th>
                <th>Publication Year</th>
                <th>Review</th>
                <th>Price</th>
                <th>Genre</th>
                <th>Status</th>
            </tr>
        </thead>

            <tbody>
                @if ($books->isEmpty())
                    <tr>
                        <td colspan="8" class="text-center">No books found</td>
                    </tr>
                @else
                    @foreach ($books as $book)
                    <tr>
                        <td>
                            {{$book->title}}
                        </td>
                        {{-- <td>
                            <a href="{{ route('book.index', $book->id) }}" class="text-decoration-none text-dark fw-bold">{{ $book->title }}</a>
                        </td> --}}
                        <td>
                            {{$book->publisher}}
                        </td>
                        <td>
                            @php
                                // 著者名を取得する
                                $authorNames = $book->authors()->pluck('name')->implode(', '); // 複数の著者がいる場合はカンマ区切りで表示
                            @endphp
                            <a href="{{ route('admin.books.index', $book->id) }}" class="text-decoration-none text-dark fw-bold">{{ $authorNames }}</a>
                        </td>
                        <td>
                            {{ $book->publication_date }}
                        </td>
                        {{-- <td>
                            {{$book->reviews->avg('star_count')}}
                        </td> --}}
                        <td>
                            @if ($book->reviews->isEmpty())
                                No data
                            @else
                                {{ $book->reviews->avg('star_count') }}
                            @endif
                        </td>
                        
                        <td>
                            {{$book->price}}
                        </td>
                        <td>
                            {{-- {{$book->genres->name}} --}}
                            @if($book->genres->isNotEmpty())
                                {{ $book->genres->pluck('name')->implode(',') }}
                            @else
                                No genre
                            @endif
                        </td>
                        <td class="text-center">
                            @if ($book->trashed())
                                <a class="btn fs-24 p-0 border-0" data-bs-toggle="modal" data-bs-target="#active-book-modal-{{ $book->id }}">
                                    <i class="fa-regular fa-face-frown text-danger"></i> Inactive
                                </a>
                            @else
                                <a class="btn fs-24 p-0 border-0" data-bs-toggle="modal" data-bs-target="#delete-book-modal-{{ $book->id }}">
                                    <i class="fa-regular fa-face-smile text-primary"></i> Active
                                </a>
                            @endif
                    </td>
                    </tr> 
                    @include('admin.books.modal.status')
                    @endforeach
                    @endif
            </tbody>
    </table>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script>
        // Book用のセレクトメニューが変更されたときに自動的にフォームを送信
        document.getElementById('manage-book-select').addEventListener('change', function() {
            document.getElementById('sortForm').submit();
        });
    
        document.getElementById('sort-order-select').addEventListener('change', function() {
            document.getElementById('sortForm').submit();
        });
    </script>
    

    <div class="d-flex justify-content-center">
        {{-- {{ $books->appends(['sort' => request('sort'), 'order' => request('order'), 'search' => request('search')])->links() }} --}}
        {{-- {{ $books->appends(['sort' => request('sort'), 'order' => request('order'), 'search' => request('search')])->links() }} --}}
        {{ $books->appends(request()->except('page'))->links() }}
    </div>
    

@endsection

