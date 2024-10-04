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
                <form action="" method="post">
                    @csrf
                    <div class="row align-items-center">
                        <div class="col pe-0 position-relative">
                            <input type="text" id="searchInput" name="search"
                                class="form-control form-control-sm rounded" placeholder=" Search genres..."
                                style="width: 400px;">
                            <button type="button" id="clearButton"
                                class="btn btn-sm position-absolute end-0 top-50 translate-middle-y rounded"
                                style="display: none; right: 30px;">
                                x
                            </button>
                        </div>
                        <div class="col ps-1">
                            <button type="submit" class="btn btn-warning btn-sm search-icon">
                                <i class="fa-solid fa-magnifying-glass text-white"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-4">
                <form action="" method="post">
                    @csrf
                    <select class="form-select w-50 mx-auto" aria-label="admin-sort">
                        <option selected>Open this select menu</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                    </select>
                </form>
            <div class="col-3">
                <select class="form-select" aria-label="admin-sort" id="manage-genre-select">
                    <option selected>Open this select menu</option>
                    <option value="1">One</option>
                    <option value="2">Two</option>
                    <option value="3">Three</option>
                </select>
            </div>
        </div>

        @include('admin.button')
    </div>
    {{-- 以下 --}}
    <div class="genre-container mt-4">
        <form action="" method="post">
            @csrf

            <div class="row align-items-center">
                <div class="col-8"></div>
                <div class="col">
                    <input type="text" class="form-control" placeholder="Add new genre" id="genreInput">
                </div>
                <div class="col-2">
                    <button type="button" class="btn btn-success" id="addGenreBtn">Add Genre</button>
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
                    <td> <a class="text-danger btn fs-24 p-0 border-0" data-bs-toggle="modal"
                            data-bs-target="#delete-genre-test">
                            <i class="fa-regular fa-face-frown"></i>
                        </a>
                        <a class="text-primary btn fs-24 p-0 border-0" data-bs-toggle="modal"
                            data-bs-target="#active-genre-test">
                            <i class="fa-regular fa-face-frown"></i>
                        </a>
                    </td>
                </tr>
            @endfor
        </tbody>
    </table>
    

    {{-- sortが選択されたときにそのジャンルのみを表示するためのコード　不完全　～L.108 --}}
    {{-- jQuery ライブラリ  --}}
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#manage-genre-select').change(function() {
                var selectedData = $(this).val();
                var tableBody = $('#manage-genre-table tbody');
    
                tableBody.empty(); // 既存の行をクリア
    

               // 選択されたデータが存在する場合、そのデータを表示
            if (selectedData in data) {
                data[selectedData].forEach(function(entry) {
                    tableBody.append(`
                        <tr>
                            <td>${entry.name}</td>
                            <td>${entry.count}</td>
                            <td>${entry.update}</td>
                            <td>${entry.status}</td>
                        </tr>
                    `);
                });
            } else {
                tableBody.append(`
                    <tr>
                        <td colspan="2">データを選択してください</td>
                    </tr>
                `);
            }
        });
    });
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

