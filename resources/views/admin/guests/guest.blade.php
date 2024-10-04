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
                                class="form-control form-control-sm rounded" placeholder=" Search guest..."
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

            </div>
        </div>
        @include('admin.button')
    </div>

    </div>

    <table class="table manage-table border-rounded">
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
                    <td> <a class="text-danger btn fs-24 p-0 border-0" data-bs-toggle="modal"
                            data-bs-target="#delete-guest-test">
                            <i class="fa-regular fa-face-frown"></i>
                        </a>
                        <a class="text-primary btn fs-24 p-0 border-0" data-bs-toggle="modal"
                            data-bs-target="#active-guest-test">
                            <i class="fa-regular fa-face-frown"></i>
                        </a>
                    </td>
                </tr>
            @endfor
        </tbody>
    </table>

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


{{--
    上部分はrowで分けて作る
    backはrowでくくる
    カードで作れるか
    下はcolで分ければいい
    パジネーとはその下に
    ステータスのアイコンが変わるようにする
    バーはボタンにする
--}}
