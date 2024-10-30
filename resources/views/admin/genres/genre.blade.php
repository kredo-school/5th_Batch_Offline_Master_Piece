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
                        <form action="{{ route('admin.genres.search') }}" style="width: 500px" class="d-flex" method="get">
                            <div class="row ms-auto">
                                <div class="col pe-0 position-relative">
                                    <input type="text" id="searchInput" name="search"
                                        class="form-control form-control-sm rounded searchInput" style="width: 400px"
                                        value="{{ request('search') }}" placeholder="Search genres...">
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
                <form id="sortForm" action="{{ route('admin.genres.show') }}" method="get">
                    <div class="d-flex justify-content-center align-items-center">
                        <select class="form-select w-50 me-2" aria-label="admin-sort" id="manage-genre-select" name="sort">
                            <option value="name" {{ request('sort') == 'name' ? 'selected' : '' }}>Name</option>
                            <option value="count" {{ request('sort') == 'count' ? 'selected' : '' }}>Count</option>
                            <option value="updated_at" {{ request('sort') == 'updated_at' ? 'selected' : '' }}>Last Update</option>
                            <option value="status" {{ request('sort') == 'status' ? 'selected' : '' }}>Status</option>
                        </select>

                        <select class="form-select w-50" aria-label="sort-order" id="sort-order-select" name="order">
                            <option value="asc" {{ request('order') == 'asc' ? 'selected' : '' }}>↑ Ascending</option>
                            <option value="desc" {{ request('order') == 'desc' ? 'selected' : '' }}>↓ Descending</option>
                        </select>
                    </div>
                </form>
            </div>
        </div>
        @include('admin.button')
    </div>

    {{-- 以下 --}}
    <div class="genre-container mt-4">
        <form action="{{ route('admin.genres.create') }}" method="post">
            @csrf

            <div class="row align-items-center">
                <div class="col-8"></div>
                <div class="col">
                    <input type="text" name="name" class="form-control" placeholder="Add new genre" id="genreInput">
                </div>
                <div class="col-2">
                    <button type="submit" class="btn btn-success" id="addGenreBtn"><i class="fa-solid fa-plus"></i>Add Genre</button>
                </div>
            </div>

        </form>
    </div>
    {{-- 間の追加オプション --}}
    <table class="table manage-table border-rounded" id="manage-genre-table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Count</th>
                <th>Last Update</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @if ($genres->isEmpty())
                <tr>
                    <td colspan="4" class="text-center">No genres found</td>
                </tr>
            @else
                @foreach ($genres as $genre)
                    <tr>
                        <td>{{ $genre->name }}</td>
                        <td>{{ $genre->genre_book->count() }}</td>
                        <td>{{ $genre->updated_at }}</td>
                        <td>
                            @if ($genre->trashed())
                                <a class="btn fs-24 p-0 border-0" data-bs-toggle="modal"
                                    data-bs-target="#active-genre-modal-{{ $genre->id }}">
                                    <i class="fa-regular fa-face-frown text-danger"></i> Inactive
                                </a>
                            @else
                                <a class="btn fs-24 p-0 border-0" data-bs-toggle="modal"
                                    data-bs-target="#delete-genre-modal-{{ $genre->id }}">
                                    <i class="fa-regular fa-face-smile text-primary"></i> Active
                                </a>
                            @endif
                        </td>
                    </tr>
                    @include('admin.genres.modal.status')
                @endforeach
            @endif
        </tbody>
    </table>
    
    
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script>
        // セレクトメニューが変更されたときに自動的にフォームを送信
        document.getElementById('manage-genre-select').addEventListener('change', function() {
            document.getElementById('sortForm').submit();
        });
        
        document.getElementById('sort-order-select').addEventListener('change', function() {
            document.getElementById('sortForm').submit();
        });
        
        </script>




    {{-- ページネーションリンクを表示 --}}
    <div class="d-flex justify-content-center">
        {{ $genres->appends(['sort' => request('sort'), 'order' => request('order'), 'search' => request('search')])->links() }}
    </div>

@endsection
