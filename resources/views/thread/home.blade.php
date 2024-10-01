@extends('layouts.app')

@section('title', 'Thread Home')

@section('content')
    <div class="container-fluid">
        @include('thread.header')

        <div class="row ms-3">
            <div class="col-10">
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
