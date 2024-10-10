@extends('layouts.app')

@section('title', 'Guest Comment')


@section('content')

    @include('users.guests.profile.contents.header')

    <div class="row justify-content-center mt-2">
        <div class="col-8 mt-3">
            <div class="p-4 d-flex justify-content-around">
                <a href="{{route('profile.show',$user->id)}}" class="fw-bold text-decoration-none fs-40 text-grey">Review</a>
                <a href="{{route('profile.bookmark',$user->id)}}" class="fw-bold text-decoration-none fs-40 text-grey">Bookmark</a>
                <a href="{{route('profile.order',$user->id)}}" class="fw-bold text-decoration-none fs-40 text-grey">Order</a>
                <a href="{{route('profile.comment',$user->id)}}" class="fw-bold text-decoration-none fs-40 text-dark">Comment</a>
            </div>
            <div class="bg-white rounded mt-2 px-5 overflow-auto profile-list">
                <div class="row">
                    <div class="col-8">
                        <h2 class="h1 fw-bold text-grey mt-3">Comment</h2>
                    </div>
                    {{-- order list --}}
                    <div class="col-4">
                        <select name="display" id="" class="form-select mt-4">
                            <option value="hidden">Display order</option>
                            <option value="">latest</option>
                            <option value="">reported</option>
                        </select>
                    </div>
                </div>

                {{-- comment list --}}
                @for ($i = 1; $i < 8; $i++)
                    <div class="row mt-5">
                        <hr>
                        <div class="col-10 fs-24">
                            <h3>Thread: <a href="#" class="text-decoration-none text-primary">Inochi no me omoshirosugi lol</a></h3>
                            <p><?= $i ?> name: <a href="#" class="text-decoration-none text-success fw-bold">Yama-D-Taro</a>: 19/9/2027 Thu.
                                14:40:10</p>
                        </div>
                        <div class="col-2 fs-24 text-end">
                            {{-- @can('admin') --}}
                                <i class="fa-solid fa-ban text-danger"></i>
                                <label class="text-danger">12</label><br>
                                <a class="text-danger btn fs-24 p-0" data-bs-toggle="modal" data-bs-target="#delete-comment-test">
                                    <i class="fa-solid fa-trash-can"></i>
                                </a>                        
                            {{-- @endcan --}}
                        </div>

                    </div>
                    <div class="px-4 fs-24">
                        <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Accusamus in rerum ab ullam amet atque autem laudantium ducimus fuga reiciendis accusantium quaerat nam, blanditiis repudiandae id sed delectus fugit doloribus?</p>
                    </div>
                @endfor
                <!-- Include the modal here -->
                @include('users.guests.profile.modal.delete')


            </div>
        </div>


    </div>




@endsection
