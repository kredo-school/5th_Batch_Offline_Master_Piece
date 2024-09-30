@extends('layouts.app')

@section('title', 'Thread Content')

@section('content')
<div class="container-fluid">
    @include('thread.header')

    <div class="row ms-3">
        <div class="col-10">
            <div class="card w-100 mb-5">
                <div class="card-header bg-white border-bottom-0">
                    <div class="text-end">
                        <a href="#" class="text-secondary">Latest comment <i class="fa-solid fa-arrow-down"></i></a>
                    </div>

                    {{-- title --}}
                    <h1 class="text-danger fw-bold">
                        This is masterpiece!!
                    </h1>
                    <p class="text-secondary mb-0">Genre: Fantasy</p>
                </div>

                <div class="card-body bg-white pt-0">
                    @for ($i = 1; $i <= 20; $i++)
                        <hr>
                        <div class="row">
                            <div class="col-10 fs-24">
                                <p><?= $i ?> name: <span class="text-success fw-bold">Yama-D-Taro</span>: 19/9/2027 Thu.
                                    14:40:10</p>
                            </div>
                            <div class="col-2 text-end">
                                <button class="btn border-0" data-bs-toggle="modal" data-bs-target="#delete-comment-postid">
                                    <div class="fs-24">
                                        <i class="fa-regular fa-trash-can text-danger"></i>
                                        <label class="text-danger">3</label>
                                    </div>
                                </button>

                                <button class="btn border-0" data-bs-toggle="modal" data-bs-target="#report-comment-postid">
                                    <div class="fs-24">
                                        <i class="fa-solid fa-ban text-danger"></i>
                                        <label class="text-danger">3</label>
                                    </div>
                                </button>
                            </div>
                            @include('thread.modals.delete-comment')
                            @include('thread.modals.report-comment')
                        </div>
                        <div class="px-4 fs-24">
                            <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Accusamus in rerum ab ullam amet atque autem laudantium ducimus fuga reiciendis accusantium quaerat nam, blanditiis repudiandae id sed delectus fugit doloribus?</p>
                        </div>
                    @endfor
                </div>
            </div>

            <div class="card">
                <div class="card-header bg-white p-0">
                    <textarea name="comment" id="comment" rows="5" placeholder="Add comment" class="form-control rounded-bottom-0 bg-white border-0"></textarea>
                </div>
                <div class="card-body bg-white">
                    <form action="" method="post" enctype="multipart/form-data">
                        @csrf
                        <label for="comment-image" class="form-label fw-bold">Image File</label>
                        <input type="file" name="comment_image" id="comment-image" class="form-control w-25 d-inline">
                        <input type="submit" value="Add comment" class="btn btn-orange float-end">
                    </form>
                </div>
            </div>
        </div>
        {{-- advertisement --}}
        <div class="col-2">
            @for ($i = 0; $i < 6; $i++)
                <a href="#">
                    <img src="{{ asset('images/93e1a9cf543ecd9d8bdaf98c51dc65a5.jpg') }}" alt=""class="thread-adv w-100 mb-3">
                </a>
            @endfor
        </div>
    </div>
</div>

@endsection
