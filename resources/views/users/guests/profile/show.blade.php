@extends('layouts.app')

@section('title', 'Guest Review')


@section('content')

    @include('users.guests.profile.contents.header')

    <div class="row justify-content-center mt-2">
        <div class="col-8 mt-3">
            <div class="p-4 d-flex justify-content-around">
                <a href="{{route('profile.show',$user->id)}}" class="fw-bold text-decoration-none fs-40 text-dark">Review</a>
                {{-- @can('admin') --}}
                    <a href="{{route('profile.bookmark')}}" class="fw-bold text-decoration-none fs-40 text-grey">Bookmark</a>
                    <a href="{{route('profile.order')}}" class="fw-bold text-decoration-none fs-40 text-grey">Order</a>
                    <a href="{{route('profile.comment')}}" class="fw-bold text-decoration-none fs-40 text-grey">Comment</a>           
                {{-- @endcan --}}
            </div>
            <div class="bg-white rounded mt-2 px-5 overflow-auto profile-list shadow">
                <h2 class="h1 fw-bold text-grey mt-3">Review</h2>

                @for ($i = 0; $i < 3; $i++)
                    <div class="row mt-4">
                        <p class="text-muted mb-0">Sep.12.2024</p>
                        <div class="col-3">
                            <a href="{{route('book.show_book')}}" class="text-decoration-none">
                                <img src="{{ asset('images/649634.png') }}" alt="$book->id" class="w-100 shadow">
                            </a>
                        </div>
                        <div class="col-9 fs-32">
                            <p>
                                <a href="{{route('book.show_book')}}" class="text-decoration-none">
                                    <p class="fs-32">$book->name</p>
                                </a>
                                <i class="fa-solid fa-star text-warning"></i>
                                <i class="fa-solid fa-star text-warning"></i>
                                <i class="fa-solid fa-star text-warning"></i>
                                <i class="fa-solid fa-star text-warning"></i>
                                <i class="fa-regular fa-star text-warning"></i>
                                This is a masterpiece!
                            </p>
                            <p class="h4">Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptate blanditiis
                                facere soluta unde cum nemo, eligendi commodi eveniet, repudiandae tenetur quo inventore.
                                Facere accusamus quibusdam obcaecati distinctio modi nobis! Dicta!

                            </p>
                        </div>

                    </div>
                    <hr>
                @endfor


            </div>
        </div>


    </div>




@endsection
