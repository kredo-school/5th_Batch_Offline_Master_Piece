@extends('layouts.app')

@section('title','Show Store')

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

    <form action="#" method="post">
        @csrf
        {{-- serch form --}}
        <div class="row d-flex justify-content-center mb-5">
            <input type="text" name="serch" id="serch" class="form-control w-25" placeholder="Search author...">
            <input type="submit" value="Search" class="btn serch-button ms-3">
        </div>
    </form>

    <form action="#" method="post">
        @csrf
        <div class="container-body" style="overflow-y: auto; height: 650px;">
            <div class="ms-3">
                <h2 class="h1 fw-bold text-grey mt-3">Authorname</h2>

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