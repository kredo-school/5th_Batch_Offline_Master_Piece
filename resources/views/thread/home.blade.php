@extends('layouts.app')

@section('title', 'thread-home')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center mb-3">
            <div class="col-auto"><img src="{{ asset('images/BB2BB7F8-CA14-4C2A-8606-2DA9E432FEB0 copy.png') }}" alt=""
                    class="thread-img"></div>
            <div class="col-auto">
                <h1 class="thread-title">Threads about Books</h1>
            </div>
        </div>

        <div class="row ms-3">
            <div class="col-10">

                <div class="row mb-5">
                    <div class="col">
                        <form action="" method="post">
                            @csrf
                            <select name="genre" id="genre" class="form-select w-50">
                                <option value="" hidden>Genre</option>
                                <option value="1">genre</option>
                                <option value="2">genre</option>
                            </select>
                        </form>
                    </div>
                    <div class="col">
                        <form action="#" style="width: 500px" class="d-flex">
                            @csrf
                            <div class="row ms-auto">
                                <div class="col pe-0 position-relative">
                                    <input type="text" id="searchInput" name="search" class="form-control rounded"
                                        style="width: 400px" placeholder="Search books..." style="width: 250px;">
                                    <button type="button" id="clearButton"
                                        class="btn btn-sm position-absolute end-0 top-50 translate-middle-y rounded"
                                        style="display: none; right: 30px;">
                                        x
                                    </button>
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

                @for ($i = 0; $i < 3; $i++)
                    <div class="card w-100 fs-24 mb-3">
                        <a href="#" class="text-decoration-none text-dark">
                            <div class="card-header bg-white">
                                <div class="row mx-2 align-items-center">
                                    <div class="col-8 ps-0">
                                        <span class="fw-bold">Title: </span>This book is masterpiece!!!!
                                    </div>
                                    <div class="col-2 pe-0 text-end text-secondary h5 mb-0">Comment: 21</div>
                                    <div class="col-2 h5 text-secondary text-end mb-0">Sep.12.2024</div>
                                </div>
                            </div>
                            <div class="card-body bg-white">
                                <div class="mx-2">
                                    <span class="fw-bold">Comment: </span>Lorem, ipsum dolor sit amet consectetur
                                    adipisicing elit. Aspernatur quos dolorum sed suscipit et eligendi error voluptatibus,
                                    quo placeat sit illo, facilis reprehenderit quam facere est nemo, harum officiis autem!
                                </div>
                            </div>
                        </a>
                    </div>
                @endfor
            </div>

            {{-- advertisement --}}
            <div class="col-2">
                @for ($i = 0; $i < 6; $i++)
                    <img src="{{ asset('images/93e1a9cf543ecd9d8bdaf98c51dc65a5.jpg') }}" alt=""
                        class="thread-adv w-100 mb-3">
                @endfor
            </div>
        </div>
    </div>
@endsection
