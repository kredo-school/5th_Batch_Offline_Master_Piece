@extends('layouts.app')

@section('title','Show Book')

@section('content')

    {{-- Back button --}}
    <div>
        <a href="{{url()->previous()}}" class="fw-bold text-decoration-none main-text btn">
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
                    <h1 class="fw-bold">Title: books->title<a href="#"><i class="fa-regular fa-bookmark"></i></a></h1>
                    <h3>Author: books->author_book->author</h3>
                    <h3>Publisher: books->publisher</h3>
                    <h3>Publish year: books->publication_date</h3>
                    <h3>Description: books->description</h3>
                    <h3 class="d-flex">Rate:   
                        <!-- Button trigger modal -->
                            <button type="button" class="btn d-flex" data-bs-toggle="modal" data-bs-target="#reviewBook">
                                <div class="star-ration ms-2 fa-lg">
                                    <span class="star" data-value="1"><i class="fa-regular fa-star"></i></span>
                                    <span class="star" data-value="2"><i class="fa-regular fa-star"></i></span>
                                    <span class="star" data-value="3"><i class="fa-regular fa-star"></i></span>
                                    <span class="star" data-value="4"><i class="fa-regular fa-star"></i></span>
                                    <span class="star" data-value="5"><i class="fa-regular fa-star"></i></span>
                                </div>
                                <div class="ms-2 fw-bold">X.X/5.0</div>
                            </button>
                        </h3>

                        @include('users.guests.book.modals.review_book')

                    <h3>Price: books->price</h3>
                    <h3>Genre: books->genre_book->genre</h3>
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
                        <h4 class="text-black my-auto w-100 ms-4">user->name</h4>
                    </a>
                    
                    <div class="d-flex mt-3">
                        <h5 class="d-flex">Rate:   
                                <div class="star-ration ms-2">
                                    <span class="star" data-value="1"><i class="fa-regular fa-star"></i></span>
                                    <span class="star" data-value="2"><i class="fa-regular fa-star"></i></span>
                                    <span class="star" data-value="3"><i class="fa-regular fa-star"></i></span>
                                    <span class="star" data-value="4"><i class="fa-regular fa-star"></i></span>
                                    <span class="star" data-value="5"><i class="fa-regular fa-star"></i></span>
                                </div>
                                <div class="ms-2">X.X/5.0</div>
                        </h5>
                        <h3 class="ms-5 fw-bold">books->title</h3>
                    </div>
                    <div class="post-time">month.day.year</div>
                    <div class="d-flex">
                        <h4 class="mt-3">book->comments</h4>
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

    {{-- Suggestion --}}
    <div class="container-body">
        <div class="row">
            <div class="col">
                <h2 class="h1 fw-bold text-grey mt-3">Suggestion</h2>
            </div>
            <div class="col text-end ">
                <a href="{{route('book.suggestion')}}" class="text-grey fs-24">
                    <p class="text-end mt-3 mb-0">
                        more <span class="h4"><i class="fa-solid fa-chevron-right"></i><i
                                class="fa-solid fa-chevron-right"></i></span>
                    </p>
                </a>
            </div>
        </div>
        {{-- Booklist --}}
        <div id="carouselSuggestionControls" class="carousel slide mt-2" data-bs-ride="carousel">
            <div class="carousel-inner">
                {{-- page1 --}}
                <div class="carousel-item active">
                    <div class="table-container mt-3">
                        @for ($i = 1; $i < 5; $i++)
                            <div class="col-3">
                                <div class="text-center ms-4">
                                    <table class="mt-3">
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <a href="{{route('book.show_book')}}" class="link-book">
                                                        <img src="https://th.bing.com/th/id/OIP.23rdUcI-az1chMeR7unEFQHaHa?w=150&h=180&c=7&r=0&o=5&dpr=2&pid=1.7" alt="#" class="img-fluid">
                                                    </a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <a href="{{route('book.show_book')}}" class="link-book">
                                                        <h4>Book->title</h4>
                                                    </a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <a href="{{route('book.author_show')}}" class="link-book">
                                                        <h5>book->author_book->authors</h5>
                                                    </a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="star-ration-list d-flex">
                                                    <span class="star" data-value="1"><i class="fa-regular fa-star"></i></span>
                                                    <span class="star" data-value="2"><i class="fa-regular fa-star"></i></span>
                                                    <span class="star" data-value="3"><i class="fa-regular fa-star"></i></span>
                                                    <span class="star" data-value="4"><i class="fa-regular fa-star"></i></span>
                                                    <span class="star" data-value="5"><i class="fa-regular fa-star"></i></span>
                                                    <div class="ms-2">X.X/5.0</div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <h4 class="text-danger">book->price</h4>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        @endfor
                    </div>
                </div>
                {{-- page2 --}}
                <div class="carousel-item">
                    <div class="table-container mt-3">
                        @for ($i = 5; $i < 9; $i++)
                            <div class="col-3">
                                <div class="text-center ms-4">
                                    <table class="mt-3">
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <a href="{{route('book.show_book')}}" class="link-book">
                                                        <img src="https://th.bing.com/th/id/OIP.23rdUcI-az1chMeR7unEFQHaHa?w=150&h=180&c=7&r=0&o=5&dpr=2&pid=1.7" alt="#" class="img-fluid">
                                                    </a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <a href="{{route('book.show_book')}}" class="link-book">
                                                        <h4>Book->title</h4>
                                                    </a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <a href="{{route('book.author_show')}}" class="link-book">
                                                        <h5>book->author_book->authors</h5>
                                                    </a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="star-ration-list d-flex">
                                                    <span class="star" data-value="1"><i class="fa-regular fa-star"></i></span>
                                                    <span class="star" data-value="2"><i class="fa-regular fa-star"></i></span>
                                                    <span class="star" data-value="3"><i class="fa-regular fa-star"></i></span>
                                                    <span class="star" data-value="4"><i class="fa-regular fa-star"></i></span>
                                                    <span class="star" data-value="5"><i class="fa-regular fa-star"></i></span>
                                                    <div class="ms-2">X.X/5.0</div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <h4 class="text-danger">book->price</h4>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        @endfor
                    </div>
                </div>
                {{-- page3 --}}
                <div class="carousel-item">
                    <div class="table-container mt-3">
                        @for ($i = 9; $i < 13; $i++)
                            <div class="col-3">
                                <div class="text-center ms-4">
                                    <table class="mt-3">
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <a href="{{route('book.show_book')}}" class="link-book">
                                                        <img src="https://th.bing.com/th/id/OIP.23rdUcI-az1chMeR7unEFQHaHa?w=150&h=180&c=7&r=0&o=5&dpr=2&pid=1.7" alt="#" class="img-fluid">
                                                    </a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <a href="{{route('book.show_book')}}" class="link-book">
                                                        <h4>Book->title</h4>
                                                    </a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <a href="{{route('book.author_show')}}" class="link-book">
                                                        <h5>book->author_book->authors</h5>
                                                    </a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="star-ration-list d-flex">
                                                    <span class="star" data-value="1"><i class="fa-regular fa-star"></i></span>
                                                    <span class="star" data-value="2"><i class="fa-regular fa-star"></i></span>
                                                    <span class="star" data-value="3"><i class="fa-regular fa-star"></i></span>
                                                    <span class="star" data-value="4"><i class="fa-regular fa-star"></i></span>
                                                    <span class="star" data-value="5"><i class="fa-regular fa-star"></i></span>
                                                    <div class="ms-2">X.X/5.0</div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <h4 class="text-danger">book->price</h4>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        @endfor
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselSuggestionControls"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselSuggestionControls"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>



    </div>
    {{-- New --}}
    <div class="container-body">
        <div class="row ms-2">
            <div class="col">
                <h2 class="h1 fw-bold text-grey mt-3">Same genre</h2>
            </div>
            <div class="col text-end ">
                <a href="{{route('book.new')}}" class="text-grey fs-24">
                    <p class="text-end mt-3 mb-0">
                        more <span class="h4"><i class="fa-solid fa-chevron-right"></i><i
                                class="fa-solid fa-chevron-right"></i></span>
                    </p>
                </a>
            </div>
        </div>
        {{-- Booklist --}}
        <div id="carouselNewControls" class="carousel slide mt-2" data-bs-ride="carousel">
            <div class="carousel-inner">
                {{-- page1 --}}
                <div class="carousel-item active">
                    <div class="table-container mt-3">
                        @for ($i = 1; $i < 5; $i++)
                            <div class="col-3">
                                <div class="text-center ms-4">
                                    <table class="mt-3">
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <a href="{{route('book.show_book')}}" class="link-book">
                                                        <img src="https://th.bing.com/th/id/OIP.23rdUcI-az1chMeR7unEFQHaHa?w=150&h=180&c=7&r=0&o=5&dpr=2&pid=1.7" alt="#" class="img-fluid">
                                                    </a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <a href="{{route('book.show_book')}}" class="link-book">
                                                        <h4>Book->title</h4>
                                                    </a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <a href="{{route('book.author_show')}}" class="link-book">
                                                        <h5>book->author_book->authors</h5>
                                                    </a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="star-ration-list d-flex">
                                                    <span class="star" data-value="1"><i class="fa-regular fa-star"></i></span>
                                                    <span class="star" data-value="2"><i class="fa-regular fa-star"></i></span>
                                                    <span class="star" data-value="3"><i class="fa-regular fa-star"></i></span>
                                                    <span class="star" data-value="4"><i class="fa-regular fa-star"></i></span>
                                                    <span class="star" data-value="5"><i class="fa-regular fa-star"></i></span>
                                                    <div class="ms-2">X.X/5.0</div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <h4 class="text-danger">book->price</h4>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        @endfor
                    </div>
                </div>
                {{-- page2 --}}
                <div class="carousel-item">
                    <div class="table-container mt-3">
                        @for ($i = 5; $i < 9; $i++)
                            <div class="col-3">
                                <div class="text-center ms-4">
                                    <table class="mt-3">
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <a href="{{route('book.show_book')}}" class="link-book">
                                                        <img src="https://th.bing.com/th/id/OIP.23rdUcI-az1chMeR7unEFQHaHa?w=150&h=180&c=7&r=0&o=5&dpr=2&pid=1.7" alt="#" class="img-fluid">
                                                    </a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <a href="{{route('book.show_book')}}" class="link-book">
                                                        <h4>Book->title</h4>
                                                    </a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <a href="{{route('book.author_show')}}" class="link-book">
                                                        <h5>book->author_book->authors</h5>
                                                    </a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="star-ration-list d-flex">
                                                    <span class="star" data-value="1"><i class="fa-regular fa-star"></i></span>
                                                    <span class="star" data-value="2"><i class="fa-regular fa-star"></i></span>
                                                    <span class="star" data-value="3"><i class="fa-regular fa-star"></i></span>
                                                    <span class="star" data-value="4"><i class="fa-regular fa-star"></i></span>
                                                    <span class="star" data-value="5"><i class="fa-regular fa-star"></i></span>
                                                    <div class="ms-2">X.X/5.0</div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <h4 class="text-danger">book->price</h4>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        @endfor
                    </div>
                </div>
                {{-- page3 --}}
                <div class="carousel-item">
                    <div class="table-container mt-3">
                        @for ($i = 9; $i < 13; $i++)
                            <div class="col-3">
                                <div class="text-center ms-4">
                                    <table class="mt-3">
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <a href="{{route('book.show_book')}}" class="link-book">
                                                        <img src="https://th.bing.com/th/id/OIP.23rdUcI-az1chMeR7unEFQHaHa?w=150&h=180&c=7&r=0&o=5&dpr=2&pid=1.7" alt="#" class="img-fluid">
                                                    </a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <a href="{{route('book.show_book')}}" class="link-book">
                                                        <h4>Book->title</h4>
                                                    </a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <a href="{{route('book.author_show')}}" class="link-book">
                                                        <h5>book->author_book->authors</h5>
                                                    </a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="star-ration-list d-flex">
                                                    <span class="star" data-value="1"><i class="fa-regular fa-star"></i></span>
                                                    <span class="star" data-value="2"><i class="fa-regular fa-star"></i></span>
                                                    <span class="star" data-value="3"><i class="fa-regular fa-star"></i></span>
                                                    <span class="star" data-value="4"><i class="fa-regular fa-star"></i></span>
                                                    <span class="star" data-value="5"><i class="fa-regular fa-star"></i></span>
                                                    <div class="ms-2">X.X/5.0</div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <h4 class="text-danger">book->price</h4>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        @endfor
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselNewControls"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselNewControls"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>



    </div>
</div>
@endsection
