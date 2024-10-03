
@extends('layouts.app')

@section('content')

                <div class="upper-container">
                        <div class="row  row align-items-center">
                                <div class="col-4">
                                    <button type="button" class="btn btn-lg">
                                        <a href="" class="text-decoration-none back ms-4"><i class="fa-solid fa-caret-left"></i> <label for="">Back</label></a>
                                    </button>
                                </div>
                                <div class="col-5">
                                    <div class="row">
                                        <div class="input-search search-bar ">
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

                        @include('admin.button')
                </div>
        {{-- 以下 --}}
        <div class="genre-container mt-4">
            <div class="row align-items-center">
                <div class="col-8"></div>
                <div class="col">
                    <input type="text" class="form-control" placeholder="Add new genre" id="genreInput">
                </div>
                <div class="col-2">
                    <button type="button" class="btn btn-success" id="addGenreBtn">Add Genre</button>
                </div>
            </div>
        </div>
        {{-- 間の追加オプション --}}

            <div class="card mt-3 card-admin-guest">
                <div class="card-header">
                    <div class="row">
                    <div class="col " >Book Name</div>
                    <div class="col " >Count</div>
                    <div class="col-3 " >Last Update</div>
                    <div class="col-2 text-center" >Status</div>
                </div>
            </div>
                <div class="card-body ">
                    <div class="row row-1 ">

                        <div class="col">
                            shoki
                        </div>
                        <div class="col" style="border-left: 1px solid;">
                            motohashi@email
                        </div>
                        <div class="col-3 " style="border-left: 1px solid;">
                            21212121
                        </div>
                        <div class="col-2 text-center" style="border-left: 1px solid;">
                            <i class="fa-regular fa-face-smile"></i>
                        </div>
                    </div>
                    <div class="row row-1 ">
                        <div class="col" >
                            shoki
                        </div>
                        <div class="col" style="border-left: 1px solid;">
                            motohashi@email
                        </div>
                        <div class="col-3 " style="border-left: 1px solid;">
                            21212121
                        </div>
                        <div class="col-2 text-center" style="border-left: 1px solid;">
                            <i class="fa-regular fa-face-smile"></i>
                        </div>
                    </div>
                    <div class="row row-1 ">
                        <div class="col"  >
                            shoki
                        </div>
                        <div class="col" style="border-left: 1px solid;">
                            motohashi@email
                        </div>
                        <div class="col-3 " style="border-left: 1px solid;">
                            21212121
                        </div>
                        <div class="col-2 text-center" style="border-left: 1px solid;">
                            <i class="fa-regular fa-face-smile"></i>
                        </div>
                    </div>
                    <div class="row row-2 ">
                        <div class="col"  >
                            shoki
                        </div>
                        <div class="col" style="border-left: 1px solid;">
                            motohashi@email
                        </div>
                        <div class="col-3 " style="border-left: 1px solid;">
                            21212121
                        </div>
                        <div class="col-2 text-center" style="border-left: 1px solid;">
                            <i class="fa-regular fa-face-smile"></i>
                        </div>
                    </div>
                </div>
                    </div>
                </div>
            </div>

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


{{--
    上部分はrowで分けて作る
    backはrowでくくる
    カードで作れるか
    下はcolで分ければいい
    パジネーとはその下に
    ステータスのアイコンが変わるようにする
    バーはボタンにする
--}}


