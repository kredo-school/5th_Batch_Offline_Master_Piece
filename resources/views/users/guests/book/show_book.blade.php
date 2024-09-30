@extends('layouts.app')

@section('title','SHOW_BOOK')

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
    
    <div class="container-body">
        <form action="#" method="post">
            @csrf
            <div class="row">
                <div class="col-4">
                    <img src="https://th.bing.com/th/id/OIP.23rdUcI-az1chMeR7unEFQHaHa?w=150&h=180&c=7&r=0&o=5&dpr=2&pid=1.7" alt="#" class="img-fluid">
                </div>
                <div class="col-8">
                    <h1 class="fw-bold">Title: <a href="#"><i class="fa-regular fa-bookmark"></i></a></h1>
                    <h3>Author: </h3>
                    <h3>Publisher: </h3>
                    <h3>Publish year: </h3>
                    <h3>Description: </h3>
                    <h3 class="d-flex">Rate:   
                        <a href="#" class="d-flex text-decoration-none text-dark">
                            <div class="star-ration ms-2">
                                <span class="star" data-value="1"><i class="fa-regular fa-star"></i></span>
                                <span class="star" data-value="2"><i class="fa-regular fa-star"></i></span>
                                <span class="star" data-value="3"><i class="fa-regular fa-star"></i></span>
                                <span class="star" data-value="4"><i class="fa-regular fa-star"></i></span>
                                <span class="star" data-value="5"><i class="fa-regular fa-star"></i></span>
                            </div>
                            <div class="ms-2">X.X/5.0</div>
                        </a>
                    </h3>
                    <h3>Price: </h3>
                    <h3>Genre: </h3>
                    <div class="row">
                        <div class="col gap-5">
                            <select name="area" id="area" class="form-control w-100">
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
                        <div class="col">
                            <input type="submit" value="Select Store" class="btn btn-select-store w-100">
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="container-body">
        <form action="#" method="post">
            @csrf
            <div class="d-flex align-items-center">
                <div class="row w-100">
                    <div class="col">
                        <h2 class="main-text fw-bold">Review</h2>
                    </div>
                    <div class="col-3">
                        <select name="sort" id="sort" class="form-control w-100">
                            <option value=""hidden>sort</option>
                            <option value="latest-arrives">Latest-arrives</option>
                            <option value="highest-rating">Highest Rating</option>
                            <option value="lowest-rating">Lowest Rating</option>
                        </select>
                    </div>
                </div>
            </div>
            @for($i = 0; $i < 5; $i++)
                <div class="review-list">
                    <a href="#" class="text-decoration-none d-flex align-items-center">
                        <div class="image-wrapper">
                            <img src="https://th.bing.com/th/id/OIP.23rdUcI-az1chMeR7unEFQHaHa?w=150&h=180&c=7&r=0&o=5&dpr=2&pid=1.7" alt="#" class="img-thumbnail rounded-circle">
                        </div>
                        <h4 class="text-black my-auto w-100 ms-4">username</h4>
                    </a>
                    
                    <div class="d-flex mt-3">
                        <h5 class="d-flex">Rate:   
                            <a href="#" class="d-flex text-decoration-none text-dark">
                                <div class="star-ration ms-2">
                                    <span class="star" data-value="1"><i class="fa-regular fa-star"></i></span>
                                    <span class="star" data-value="2"><i class="fa-regular fa-star"></i></span>
                                    <span class="star" data-value="3"><i class="fa-regular fa-star"></i></span>
                                    <span class="star" data-value="4"><i class="fa-regular fa-star"></i></span>
                                    <span class="star" data-value="5"><i class="fa-regular fa-star"></i></span>
                                </div>
                                <div class="ms-2">X.X/5.0</div>
                            </a>
                        </h5>
                        <h3 class="ms-5 fw-bold">Title</h3>
                    </div>
                    <div class="post-time">month.day.year</div>
                    <div class="d-flex">
                        <h4 class="mt-3">comment</h4>
                        <button class="fa-thumbs ms-auto d-flex"><i class="fa-regular fa-thumbs-up "></i><h5 class="my-auto fw-bold ms-2">999</h5></button>
                        <button class="fa-thumbs d-flex"><i class="fa-regular fa-thumbs-down "></i><h5 class="my-auto fw-bold ms-2">999</h5></button>
                    </div>
                </div>
                <hr>
            @endfor
        </form>
        <form action="#" method="post">
            @csrf
            <div class="review-list">
                <label for="write-review" class="form-label fw-bold">Write your review</label>
                <div class="border border-1 border-black p-3">
                    <div class="row">
                        <h6 class="d-flex ms-2">Rate:   
                            <div class="star-ration ms-2">
                                <span class="star" data-value="1"><i class="fa-regular fa-star"></i></span>
                                <span class="star" data-value="2"><i class="fa-regular fa-star"></i></span>
                                <span class="star" data-value="3"><i class="fa-regular fa-star"></i></span>
                                <span class="star" data-value="4"><i class="fa-regular fa-star"></i></span>
                                <span class="star" data-value="5"><i class="fa-regular fa-star"></i></span>
                            </div>
                            <div class="ms-2">X.X/5.0</div>
                        </h6>
                    </div>
                    <textarea name="review-title" id="review-title" rows="1" class="form-control border-0 review-wide" placeholder="Title:"></textarea>
                    <hr>
                    <textarea name="review-content" id="review-content" rows="4" class="form-control border-0 review-wide" placeholder="Content:"></textarea>
                </div>
            </div>
            <div class="review-list text-end">
                <input type="submit" value="Post Review" class="btn mt-3 btn-select-store px-5">
            </div>
        </form>

        
    </div>

@endsection
