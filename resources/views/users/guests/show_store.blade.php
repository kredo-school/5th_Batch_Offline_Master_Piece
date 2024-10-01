@extends('layouts.app')

@section('title','SHOW_STORE')

@section('content')
    {{-- Back button --}}
    <div>
        <a href="#" class="fw-bold text-decoration-none main-text btn">
            <div class="h2 fw-semibold">
                <i class="fa-solid fa-caret-left"></i>
                <div class="d-inline main-text">Back</div>
            </div>
        </a>
    </div>
    
    <form action="#" method="post">
        @csrf
        <div class="mb-5 d-flex justify-content-center mx-auto">
            <select name="area" id="area" class="form-control w-25">
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
            <div class="row ms-3">
                <div class="col pe-0 position-relative">
                    <input type="text" id="searchInput" name="search" class="form-control form-control-sm rounded" style="width: 400px" placeholder="Search store..." style="width: 250px;">
                    <button type="button" id="clearButton" class="btn btn-sm position-absolute end-0 top-50 translate-middle-y rounded" style="display: none; right: 30px;">
                        x
                    </button>
                </div>
                <div class="col ps-1">
                    <button type="submit" class="btn btn-warning btn-sm search-icon">
                        <i class="fa-solid fa-magnifying-glass text-white"></i>
                    </button>
                </div>
            </div>
        </div>
    </form>
        <div class="container-body">
            <h1 class="h3 main-text fw-bold">Store Information</h1>
                <div class="row ms-3 my-5">
                    <div class="col-4">
                        <img src="https://th.bing.com/th/id/OIP.Khe4un4CrKghna_BBciHDgHaHa?w=148&h=180&c=7&r=0&o=5&dpr=2&pid=1.7" alt="#" class="img-store-inventory">
                    </div>
                    <div class=" col my-auto ms-5">
                        <h2 class="fw-bold">Store name</h2>
                        <h4>0120-123-456</h4>
                        <h3> Japan Tokyo 12345</h3>
                    </div>
                </div>
                <h4 class="ms-3">Introduction:</h4>
                <h5 class="ms-5">Lorem ipsum dolor sit amet consectetur adipisicing elit. Sapiente nemo pariatur sed libero voluptates ipsa est, aliquam nisi dolores, ducimus quis dolor officiis placeat nulla laudantium quas delectus debitis quam!</h5>
        </div>
@endsection