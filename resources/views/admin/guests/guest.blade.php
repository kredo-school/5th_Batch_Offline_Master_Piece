@extends('layouts.app')

@section('content')

{{-- <div class="container"> --}}
                <div class="upper-container">
                        <div class="row  row align-items-center">
                                <div class="col-4">
                                    <button type="button" class="btn btn-lg">
                                        <a href="" class="text-decoration-none back ms-4"><i class="fa-solid fa-caret-left"></i> <label for="">Back</label></a>
                                    </button>
                                </div>
                                <div class="col-5">
                                    <div class="row">
                                        <div class="input-search search-bar  ">
                                            {{-- <button type="button" id="clearButton" class="btn btn-sm position-absolute start- rounded text-decoration-none">
                                                x
                                            </button> --}}
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
                                            <option value="1">One</option>
                                            <option value="2">Two</option>
                                            <option value="3">Three</option>
                                        </select>
                                    </div>
                        </div>
                        {{-- <div class="row  mt-4 text-center justify-content-center">
                            <div class="btn-group group-admin-button text-decoration-none " role="group" aria-label="group">
                                <button type="button" class="btn disabled col-3 disabled-admin"><p class="manage text-center">Manage Guest</p></button>
                                <button type="button" class="btn  btn-outline col-3"><p class="manage text-center">Manage Store</button>
                                <button type="button" class="btn  btn-outline col-3"><p class="manage text-center">Manage Genre</button>
                                <button type="button" class="btn  btn-outline col-3"><p class="manage text-center">Manage Book</button>
                            </div>
                        </div> --}}
                        @include('admin.button')

                </div>

            <div class="card mt-5 card-admin-guest">
                <div class="card-header">
                    <div class="row">
                    <div class="col-2 " ></div>
                    <div class="col-2 " >Name</div>
                    <div class="col-4 " >Email</div>
                    <div class="col-2 text-center" >Report</div>
                    <div class="col-2 text-center" >Status</div>
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
