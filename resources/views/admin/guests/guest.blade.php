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
                                        style="width: 400px" placeholder="Search guests...">
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
                    <select class="form-select w-50 mx-auto" aria-label="admin-sort" id="manage-guest-select">
                        <option selected>Open this select menu</option>
                        <option value="name">name</option>
                        <option value="report">report</option>
                        <option value="status">status</option>
                    </select>
                </form>

            </div>
        </div>
        @include('admin.button')
    </div>

    </div>

    <table class="table manage-table border-rounded" id="manage-guest-table">
        <thead>
            <tr>
                <th></th>
                <th>Name</th>
                <th>Email</th>
                <th>Report</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @for ($i = 0; $i < 5; $i++)
                <tr>
                    <td></td>
                    <td>shoki</td>
                    <td>motohashi@email</td>
                    <td>21</td>
                    <td>
                        @if (1)
                            <a class="btn fs-24 p-0 border-0" data-bs-toggle="modal" data-bs-target="#delete-guest-test">
                                <i class="fa-regular fa-face-smile text-primary"></i> Active
                            </a>
                        @else
                            <a class="btn fs-24 p-0 border-0" data-bs-toggle="modal" data-bs-target="#active-guest-test">
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
    document.getElementById('manage-guest-select').addEventListener('change', function() {
        var table = document.getElementById('manage-guest-table').getElementsByTagName('tbody')[0];
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
                return 2;
            case 'report':
                return 4;
            case 'status':
                return 5;
            default:
                return 2; // デフォルトはnameカラム
        }
    }
</script>


    @include('admin.guests.modal.status')

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

    </div>
@endsection

