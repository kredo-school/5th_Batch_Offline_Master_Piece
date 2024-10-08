@extends('layouts.app')

@section('title','Book Inventory')

@section('content')
    {{-- Back button --}}
    <div>
        <a href="{{url()->previous()}}" class="fw-bold text-decoration-none main-text btn border-0">
            <div class="h2 fw-semibold">
                <i class="fa-solid fa-caret-left"></i>
                <div class="d-inline main-text">Back</div>
            </div>
        </a>
    </div>

    <form action="#" method="post">
        @csrf

        <div class="mb-5 d-flex justify-content-center mx-auto">
            <select name="area" id="area" class="form-select w-25">
                <option value="" hidden>area</option>
                <<option value="hokkaido">Hokkaido</option>
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
                <div class="col">
                    <form action="#" style="width: 500px" class="d-flex">
                        @csrf
                        <div class="row ms-auto">
                            <div class="col pe-0 position-relative">
                                <input type="text" id="searchInput" name="search" class="form-control rounded searchInput"
                                    style="width: 400px" placeholder="Search books...">
                                    <span id="clearButton" class="clearButton">&times;</span>
                            </div>
                            <div class="col ps-1">
                                <button type="submit" class="btn btn-warning search-icon">
                                    <i class="fa-solid fa-magnifying-glass text-white"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="container-body">
            <div class="row">
                <div class="col-1"></div>
                <div class="col-3">
                    <a href="{{route('book.show_book')}}">
                        <img src="{{ asset('images/649634.png') }}" alt="$book->id" class="w-100 shadow">
                    </a>
                </div>
                <div class="col-1"></div>
                <div class="col-7 fs-32">
                    <p>
                        <a href="{{route('book.show_book')}}" class="link-book">
                            <p class="fs-32">$book->name</p>
                        </a>
                        <a href="{{route('book.author_show')}}" class="link-book">
                            <p class="h4">$book->author->name
                        </a>
                        </p>
                        <i class="fa-solid fa-star text-warning"></i>
                        <i class="fa-solid fa-star text-warning"></i>
                        <i class="fa-solid fa-star text-warning"></i>
                        <i class="fa-solid fa-star text-warning"></i>
                        <i class="fa-regular fa-star text-warning"></i>
                        4.2/5.0
                    </p>
                    <p class="text-danger fs-32 mt-5">¥23,000</p>
                </div>
            </div>
        </div>

        <div class="container-body" style="overflow-y: auto; height: 650px;">
            <h1 class="h3 main-text fw-bold">Select Store</h1>
            @for($i = 0; $i < 8; $i++)
                <div class="row ms-3">
                    <div class="col-4">
                        <img src="https://th.bing.com/th/id/OIP.Khe4un4CrKghna_BBciHDgHaHa?w=148&h=180&c=7&r=0&o=5&dpr=2&pid=1.7" alt="#" class="img-store-inventory">
                    </div>
                    <div class=" col-4 my-auto">
                        <h3>Store name</h3>
                        <h5>0120-123-456</h5>
                        <h4> Japan Tokyo 12345</h4>
                    </div>
                    <div class="col-4 my-auto">
                        <h3>Inventory: number</h3>
                        <h6>Receiving Date: Right now or 3days later </h6>
                            <input type="number" name="inventory" id="inventory" class="form-control w-50" placeholder="Quantity">
                    </div>
                </div>
                <hr>
            @endfor
        </div>
        <div class="text-end w-75 mx-auto">
            <input type="submit" value="select" class="btn btn-primary btn-select-inventory">
        </div>
    </form>
@endsection
