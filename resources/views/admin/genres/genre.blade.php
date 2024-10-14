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
                        <form action="#" style="width: 500px" class="d-flex">
                            @csrf
                            <div class="row ms-auto">
                                <div class="col pe-0 position-relative">
                                    <input type="text" id="searchInput" name="search" class="form-control form-control-sm rounded searchInput"
                                        style="width: 400px" placeholder="Search genres...">
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
                <form action="" method="post">
                    @csrf
                    <select class="form-select w-50 mx-auto" aria-label="admin-sort" id="manage-genre-select">
                        <option selected>Open this select menu</option>
                        <option value="1">name</option>
                        <option value="2">count</option>
                        <option value="3">update_at</option>
                        <option value="4">status</option>
                    </select>
                </form>

            </div>
        </div>
        @include('admin.button')
    </div>

    </div>
    {{-- 以下 --}}
    <div class="genre-container mt-4">
        <form action="{{route('admin.genres.create')}}" method="post">
            @csrf

            <div class="row align-items-center">
                <div class="col-8"></div>
                <div class="col">
                    <input type="text" name="name" class="form-control" placeholder="Add new genre" id="genreInput">
                </div>
                <div class="col-2">
                    <button type="submit" class="btn btn-success" id="addGenreBtn">Add Genre</button>
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
            @for ($i = 0; $i < 5; $i++)
                <tr>
                    <td>shoki</td>
                    <td>21</td>
                    <td>19/2/2023</td>
                    <td>
                        @if (1)
                            <a class="btn fs-24 p-0 border-0" data-bs-toggle="modal" data-bs-target="#delete-genre-test">
                                <i class="fa-regular fa-face-smile text-primary"></i> Active
                            </a>
                        @else
                            <a class="btn fs-24 p-0 border-0" data-bs-toggle="modal" data-bs-target="#active-genre-test">
                                <i class="fa-regular fa-face-frown text-danger"></i> Inactive
                            </a>
                        @endif
                    </td>
                </tr>
            @endfor
        </tbody>
    </table>


    {{-- sortが選択されたときにそのジャンルのみを表示するためのコード　不完全　～L.108 --}}
    {{-- jQuery ライブラリ  --}}
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script>
    document.getElementById('manage-genre-select').addEventListener('change', function() {
        var table = document.getElementById('manage-genre-table').getElementsByTagName('tbody')[0];
        var rows = Array.from(table.rows);
        var sortBy = this.value;

        rows.sort(function(rowA, rowB) {
            var cellA = rowA.querySelector('td:nth-child(' + getColumnIndex(sortBy) + ')').innerText.toLowerCase();
            var cellB = rowB.querySelector('td:nth-child(' + getColumnIndex(sortBy) + ')').innerText.toLowerCase();

            if (sortBy === 'report') {
                // レポート数は数値で比較する
                return parseInt(cellB) - parseInt(cellA); // 降順に並べる
            } else {
                // その他は文字列でアルファベット順に並べる
                return cellA.localeCompare(cellB);
            }
        });

        // Sort後にテーブルを再描画
        rows.forEach(function(row) {
            table.appendChild(row);
        });
    });

    function getColumnIndex(sortBy) {
        switch (sortBy) {
            case 'name':
                return 0;
            case 'count':
                return 1;
            case 'update_at':
                return 2;
            case 'status':
                return 3;
            default:
                return 1; // デフォルトはnameカラム
        }
    }
</script>

    @include('admin.genres.modal.status')


    <div class="under-container mt-5">
        <nav aria-label="Page navigation mt-5 ">
            <ul class="pagination justify-content-center paginate-bar mx-auto">
                <li class="page-item disabled">
                    <a class="page-link">Previous</a>
                </li>
                <li class="page-item"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item">
                    <a class="page-link" href="#">Next</a>
                </li>
            </ul>
        </nav>
    </div>
@endsection

