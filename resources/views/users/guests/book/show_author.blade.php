@extends('layouts.app')

@section('title','Show Store')

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

    {{-- <form action="#" method="post" style="width: auto" class="d-flex mb-5">
        @csrf
        <div class="row justify-content-center">
            <div class="col-auto pe-0 position-relative">
                <input type="text" id="searchInput" name="search"
                class="form-control rounded ms-auto" style="width: 400px;" placeholder="Search author...">
                <span id="clearButton" class="clearButton">&times;</span>
                @include('layouts.searchbar')
            </div>
            <div class="col-auto ps-1">
                <input type="submit" value="Search" class="btn serch-button ms-3">
            </div>
        </div>
    </form> --}}

    <div class="row justify-content-center mb-5">
        <div class="col-5">
            <form action="#" style="width: 500px" class="d-flex">
                @csrf
                <div class="row ms-auto">
                    <div class="col pe-0 position-relative">
                        <input type="text" id="searchInput" name="search" class="form-control rounded"
                            style="width: 400px" placeholder="Search threads...">
                            <span id="clearButton" class="clearButton">&times;</span>
                            @include('layouts.searchbar')
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

    <form action="#" method="post">
        @csrf
        <div class="container-body" style="overflow-y: auto; height: 650px;">
            <div class="ms-3">
                <h2 class="h1 fw-bold text-grey mt-3">Author name</h2>

                @for ($i = 0; $i < 3; $i++)
                    <div class="row mt-4">
                        <div class="col-3">
                            <a href="{{route('book.show_book')}}">
                                <img src="{{ asset('images/649634.png') }}" alt="$book->id" class="w-100 shadow">
                            </a>
                        </div>
                        <div class="col-6 fs-32">
                            <p>
                                <a href="{{route('book.show_book')}}" class="link-book">
                                    <p class="fs-32">$book->name</p>
                                </a>
                                <p class="h4">$book->author->name
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
                        <div class="col-3">
                            <div class="h-75 text-end">
                                <a href="#"><i class="fa-regular fa-bookmark text-warning h1"></i></a>
                            </div>
                            <div class="h-25 pt-3">
                                <a href="#" class="btn btn-orange bottom-0 w-100">Add to Cart</a>
                            </div>
                        </div>
                    </div>
                    <hr>
                @endfor
            </div>
        </div>
    </form>
@endsection
