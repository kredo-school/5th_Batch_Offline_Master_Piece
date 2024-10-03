@extends('layouts.app')

@section('content')
    <div class="upper-container">
        <div class="row  row align-items-center">
            <div class="col-4">
                <div>
                    <a href="{{ url()->previous() }}" class="fw-bold text-decoration-none main-text btn">
                        <div class="h2 fw-semibold">
                            <i class="fa-solid fa-caret-left"></i>
                            <div class="d-inline main-text">Back</div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-5">
                <div class="row">
                    <div class="input-search search-bar  ">

                        <input type="text" class="col-8 rounded search-input" placeholder="  search users">
                        <button type="submit" class="btn btn-warning btn-sm search-icon col">
                            <i class="fa-solid fa-magnifying-glass text-white"></i>
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <select class="form-select" aria-label="admin-sort">
                    <option selected>Open this select menu</option>
                    <option value="1">New</option>
                    <option value="2">report</option>
                    <option value="3">status</option>
                </select>
            </div>
        </div>

        @include('admin.button')

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
