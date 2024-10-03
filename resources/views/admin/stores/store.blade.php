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
                <div class="row align-items-center">
                    <div class="col pe-0 position-relative">
                        <form action="" method="post">
                            @csrf
                            <input type="text" id="searchInput" name="search" class="form-control form-control-sm rounded" placeholder=" Search books..." style="width: 400px;">
                            <button type="button" id="clearButton" class="btn btn-sm position-absolute end-0 top-50 translate-middle-y rounded" style="display: none; right: 30px;">
                                x
                            </button>
                        </form>
                    </div>
                    <div class="col ps-1">
                        <button type="submit" class="btn btn-warning btn-sm search-icon">
                            <i class="fa-solid fa-magnifying-glass text-white"></i>
                        </button>
                    </div>
                </div>
            </div>

            <div class="col-4">
                <select class="form-select w-50 mx-auto" aria-label="admin-sort">
                    <option value="" hidden>area</option>
                    <option value="hokkaido">Hokkaido</option>
                    <option value="aomori">Aomori</option>
                    <option value="iwate">Iwate</option>
                    <option value="miyagi">Miyagi</option>
                    <option value="akita">Akita</option>
                    <option value="yamagata">Yamagata</option>
                    <option value="fukushima">Fukushima</option>
                    <option value="ibaraki">Ibaraki</option>
                    <option value="tochigi">Tochigi</option>
                    <option value="gunma">Gunma</option>
                    <option value="saitama">Saitama</option>
                    <option value="chiba">Chiba</option>
                    <option value="tokyo">Tokyo</option>
                    <option value="kanagawa">Kanagawa</option>
                    <option value="niigata">Niigata</option>
                    <option value="toyama">Toyama</option>
                    <option value="ishikawa">Ishikawa</option>
                    <option value="fukui">Fukui</option>
                    <option value="yamanashi">Yamanashi</option>
                    <option value="nagano">Nagano</option>
                    <option value="gifu">Gifu</option>
                    <option value="shizuoka">Shizuoka</option>
                    <option value="aichi">Aichi</option>
                    <option value="mie">Mie</option>
                    <option value="shiga">Shiga</option>
                    <option value="kyoto">Kyoto</option>
                    <option value="osaka">Osaka</option>
                    <option value="hyogo">Hyogo</option>
                    <option value="nara">Nara</option>
                    <option value="wakayama">Wakayama</option>
                    <option value="tottori">Tottori</option>
                    <option value="shimane">Shimane</option>
                    <option value="okayama">Okayama</option>
                    <option value="hiroshima">Hiroshima</option>
                    <option value="yamaguchi">Yamaguchi</option>
                    <option value="tokushima">Tokushima</option>
                    <option value="kagawa">Kagawa</option>
                    <option value="ehime">Ehime</option>
                    <option value="kochi">Kochi</option>
                    <option value="fukuoka">Fukuoka</option>
                    <option value="saga">Saga</option>
                    <option value="nagasaki">Nagasaki</option>
                    <option value="kumamoto">Kumamoto</option>
                    <option value="oita">Oita</option>
                    <option value="miyazaki">Miyazaki</option>
                    <option value="kagoshima">Kagoshima</option>
                    <option value="okinawa">Okinawa</option>
                </select>
            </div>
        </div>

        @include('admin.button')

    </div>
    {{-- 以下 --}}

    <div class="card mt-5 card-admin-guest">
        <div class="card-header">
            <div class="row">
                <div class="col-2 text-center">Store</div>
                <div class="col-2 ">Name</div>
                <div class="col-3 ">Email</div>
                <div class="col-2 ">Phone</div>
                <div class="col-2 ">Address</div>
                <div class="col-1 text-center">Status</div>
            </div>

        </div>
        <div class="card-body ">
            <div class="row row-1 ">
                <div class="col-2 text-center">
                    <img src="{{ asset('/images/BB2BB7F8-CA14-4C2A-8606-2DA9E432FEB0.png') }}" class="rounded admin-image"
                        alt="...">
                </div>
                <div class="col-2" style="border-left: 1px solid;">
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
                    <img src="{{ asset('/images/BB2BB7F8-CA14-4C2A-8606-2DA9E432FEB0.png') }}" class="rounded admin-image"
                        alt="...">
                </div>
                <div class="col-2" style="border-left: 1px solid;">
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
                    <img src="{{ asset('/images/BB2BB7F8-CA14-4C2A-8606-2DA9E432FEB0.png') }}" class="rounded admin-image"
                        alt="...">
                </div>
                <div class="col-2" style="border-left: 1px solid;">
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
                    <img src="{{ asset('/images/BB2BB7F8-CA14-4C2A-8606-2DA9E432FEB0.png') }}" class="rounded admin-image"
                        alt="...">
                </div>
                <div class="col-2" style="border-left: 1px solid;">
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
