@extends('layouts.app')

@section('title', 'Guest Review')


@section('content')

    @include('guests.profile.contents.header')

    <div class="row justify-content-center mt-2">
        <div class="col-8 mt-3">
            <div class="p-4 d-flex justify-content-around">
                <a href="{{route('profile.show')}}" class="fw-bold text-decoration-none fs-40 text-grey">Review</a>
                <a href="{{route('profile.bookmark')}}" class="fw-bold text-decoration-none fs-40 text-grey">Bookmark</a>
                <a href="{{route('profile.order')}}" class="fw-bold text-decoration-none fs-40 text-grey">Order</a>
                <a href="{{route('profile.comment')}}" class="fw-bold text-decoration-none fs-40 text-dark">Comment</a>
            </div>
            <div class="bg-white rounded mt-2 px-5 overflow-auto profile-list">
                <div class="row">
                    <div class="col-8">
                        <h2 class="h1 fw-bold text-grey mt-3">Comment</h2>
                    </div>
                    <div class="col-4">
                        <select name="display" id="" class="form-select mt-4">
                            <option value="hidden">Display order</option>
                            <option value="">latest</option>
                            <option value="">reported</option>
                        </select>
                    </div>
                </div>

                @for ($i = 1; $i < 8; $i++)
                    <div class="row mt-5">
                        <hr>
                        <div class="col-10 fs-24">
                            <p><?= $i ?> name: <span class="text-success fw-bold">Yama-D-Taro</span>: 19/9/2027 Thu.
                                14:40:10</p>
                        </div>
                        <div class="col-2 fs-24 text-end">
                            <i class="fa-solid fa-ban text-danger"></i>
                            <label class="text-danger">12</label>
                        </div>
                    </div>
                    <div class="px-4 fs-24">
                        <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Accusamus in rerum ab ullam amet atque autem laudantium ducimus fuga reiciendis accusantium quaerat nam, blanditiis repudiandae id sed delectus fugit doloribus?</p>
                    </div>
                @endfor


            </div>
        </div>


    </div>




@endsection
