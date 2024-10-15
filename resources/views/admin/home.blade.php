@extends('layouts.app')

@section('content')

<!-- CSS -->
<link rel="stylesheet" href="{{asset('css/style.css')}}">

<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col">
            <div class="card card-admin mt-3 mx-auto w-75">
                <h2 class="text-center mt-5 display-2 ">Welcome $User</h2>

                <div class="card-body mx-auto w-75 mt-3">
                    <div class="row border" style="border-radius: 15px;">
                        <!-- Store Button -->
                        <a href="{{ route('admin.store') }}" class="admin-home-btn col-3 btn">
                            <i class="i-admin fa-solid fa-shop"></i>
                        </a>
                        <div class="col-9">
                            <h2>Store</h2>
                            <p class="fw-bold">You can check registered store and status.<br>
                            You can add the store on this page.<br>
                            You can move to the store page, push the store icon.</p>
                        </div>
                    </div>
                </div>

                <div class="card-body mx-auto w-75">
                    <div class="row border" style="border-radius: 15px;">
                        <!-- Book Button -->
                        <a href="{{ route('admin.book') }}" class="admin-home-btn col-3 btn">
                            <i class="i-admin fa-solid fa-book-open"></i>
                        </a>
                        <div class="col-9">
                            <h2>Book</h2>
                            <p class="fw-bold">You can check registered book and status.<br>
                            You can add the book on this page.<br>
                            You can move to the book page, push the book icon.</p>
                        </div>
                    </div>
                </div>

                <div class="card-body mx-auto w-75">
                    <div class="row border" style="border-radius: 15px;">
                        <!-- Guest Button -->
                        <a href="{{ route('admin.guest') }}" class="admin-home-btn col-3 btn">
                            <i class="i-admin fa-regular fa-user"></i>
                        </a>
                        <div class="col-9">
                            <h2>Guest</h2>
                            <p class="fw-bold">You can check registered guest and status.<br>
                            You can delete the guest on this page.<br>
                            You can move to guest page, push the guest icon.</p>
                        </div>
                    </div>
                </div>

                <div class="card-body mx-auto w-75 mb-5">
                    <div class="row border" style="border-radius: 15px;">
                        <!-- Genre Button -->
                        <a href="{{ route('admin.genres.show') }}" class="admin-home-btn col-3 btn">
                            <i class="i-admin fa-solid fa-table-cells-large"></i>
                        </a>
                        <div class="col-9">
                            <h2>Genre</h2>
                            <p class="fw-bold">You can check registered genre and status.<br>
                            You can add the genre on this page.<br>
                            You can move to genre page, push the genre icon.</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

@endsection
