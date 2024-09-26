@extends('layouts.app')

@section('title', 'Guest order')


@section('content')

    @include('guests.profile.contents.header')

    <div class="row justify-content-center mt-2">
        <div class="col-8 mt-3">
            <div class="p-4 d-flex justify-content-around">
                <a href="{{route('profile.show')}}" class="fw-bold text-decoration-none fs-40 text-grey">Review</a>
                <a href="{{route('profile.bookmark')}}" class="fw-bold text-decoration-none fs-40 text-grey">Bookmark</a>
                <a href="{{route('profile.order')}}" class="fw-bold text-decoration-none fs-40 text-dark">Order</a>
                <a href="{{route('profile.comment')}}" class="fw-bold text-decoration-none fs-40 text-grey">Comment</a>
            </div>
            <div class="bg-white rounded mt-2 px-5 overflow-auto profile-list">
                <h2 class="h1 fw-bold text-grey mt-3">Order</h2>

                @for ($i = 0; $i < 3; $i++)
                <div class="row mt-4">
                        <p class="text-muted">Sep.12.2024</p>
                        <div class="col-3">
                            <img src="{{ asset('images/649634.png') }}" alt="$book->id" class="w-100 shadow">
                        </div>
                        <div class="col-6 fs-32">
                            <p>
                                <p class="fs-32">$book->name</p>
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
                                <a href="#" class="btn btn-orange bottom-0 w-100">Select Store</a>
                            </div>
                            
                            
                        </div>



                    </div>
                    <hr>
                @endfor


            </div>
        </div>


    </div>




@endsection
