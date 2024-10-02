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
            
                        <div class="row mt-4 text-center justify-content-center">
                            <div class="btn-group group-admin-button text-decoration-none" role="group" aria-label="group">
                                <button type="button" class="btn col-3  d-flex align-items-center justify-content-center manage-guest-btn-1">
                                    <p class="manage m-0">Manage Guest</p>
                                </button>
                                <button type="button" class="btn btn-outline col-3 d-flex align-items-center justify-content-center manage-group-button disabled disabled-admin manage-store-btn">
                                    <p class="manage m-0">Manage Store</p>
                                </button>
                                <button type="button" class="btn btn-outline col-3 d-flex align-items-center justify-content-center  manage-group-button">
                                    <p class="manage m-0">Manage Genre</p>
                                </button>
                                <button type="button" class="btn btn-outline col-3 d-flex align-items-center justify-content-center ">
                                    <p class="manage m-0">Manage Book</p>
                                </button>
                            </div>
                        </div>
                        
                </div>
        {{-- 以下 --}}
                
            <div class="card mt-5 card-admin-guest">
                <div class="card-header">
                    <div class="row">
                    <div class="col-2 text-center" >Store</div>
                    <div class="col-2 " >Name</div>
                    <div class="col-3 " >Email</div>
                    <div class="col-2 " >Phone</div>
                    <div class="col-2 " >Address</div>
                    <div class="col-1 text-center" >Status</div>
                </div>

                </div>
                <div class="card-body ">
                    <div class="row row-1 ">
                        <div class="col-2 text-center">
                            <img src="{{ asset('/images/BB2BB7F8-CA14-4C2A-8606-2DA9E432FEB0.png') }}" class="rounded admin-image" alt="...">
                        </div>
                        <div class="col-2"  style="border-left: 1px solid;">
                            shoki
                        </div>
                        <div class="col-3" style="border-left: 1px solid;">
                            motohashi@email
                        </div>
                        <div class="col-2 " style="border-left: 1px solid;">
                            21212121
                        </div>
                        <div class="col-2 " style="border-left: 1px solid;">
                            chiba abiko
                        </div>
                        <div class="col-1 text-center" style="border-left: 1px solid;">
                            <i class="fa-regular fa-face-smile"></i>
                        </div>
                    </div>
                    <div class="row row-1 ">
                        <div class="col-2 text-center">
                            <img src="{{ asset('/images/BB2BB7F8-CA14-4C2A-8606-2DA9E432FEB0.png') }}" class="rounded admin-image" alt="...">
                        </div>
                        <div class="col-2"  style="border-left: 1px solid;">
                            shoki
                        </div>
                        <div class="col-3" style="border-left: 1px solid;">
                            motohashi
                        </div>
                        <div class="col-2 " style="border-left: 1px solid;">
                            21
                        </div>
                        <div class="col-2 " style="border-left: 1px solid;">
                            21
                        </div>
                        <div class="col-1 text-center" style="border-left: 1px solid;">
                            <i class="fa-regular fa-face-smile"></i>
                        </div>
                    </div>
                    <div class="row row-1 ">
                        <div class="col-2 text-center">
                            <img src="{{ asset('/images/BB2BB7F8-CA14-4C2A-8606-2DA9E432FEB0.png') }}" class="rounded admin-image" alt="...">
                        </div>
                        <div class="col-2"  style="border-left: 1px solid;">
                            shoki
                        </div>
                        <div class="col-3" style="border-left: 1px solid;">
                            motohashi
                        </div>
                        <div class="col-2 " style="border-left: 1px solid;">
                            21
                        </div>
                        <div class="col-2 " style="border-left: 1px solid;">
                            21
                        </div>
                        <div class="col-1 text-center" style="border-left: 1px solid;">
                            <i class="fa-regular fa-face-smile"></i>
                        </div>
                    </div>
                    <div class="row row-2">
                        <div class="col-2 text-center">
                            <img src="{{ asset('/images/BB2BB7F8-CA14-4C2A-8606-2DA9E432FEB0.png') }}" class="rounded admin-image" alt="...">
                        </div>
                        <div class="col-2"  style="border-left: 1px solid;">
                            shoki
                        </div>
                        <div class="col-3" style="border-left: 1px solid;">
                            motohashi
                        </div>
                        <div class="col-2 " style="border-left: 1px solid;">
                            21
                        </div>
                        <div class="col-2 " style="border-left: 1px solid;">
                            21
                        </div>
                        <div class="col-1 text-center" style="border-left: 1px solid;">
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