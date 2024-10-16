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
                        <a href="{{url()->current(). '?page=' .$latestPage. '#comment-' .count($thread->comments)}}" class="text-secondary">Latest comment <i class="fa-solid fa-arrow-down"></i></a>
                    </div>

                    {{-- title --}}
                    <h1 class="text-danger fw-bold">
                        {{$thread->title}}
                    </h1>
                    <p class="text-secondary mb-0">
                        Genre:
                        @foreach ($genres as $genre_id)
                            {{$genre_id->genre->name}}
                        @endforeach

                        <span class="float-end">
                            @can('admin')
                                <button class="btn btn-danger border-0" data-bs-toggle="modal" data-bs-target="#delete-thread-{{$thread->id}}">
                                    Delete thread
                                </button>
                                @include('thread.modals.delete-thread')
                            @endcan
                        </span>
                    </p>
                </div>

                <div class="card-body bg-white pt-0">
                    @foreach($comments->take(100) as $comment)
                        <hr>
                        <div class="row">
                            <div class="col-10 fs-5">
                                <p>{{$comments->firstItem() + $loop->index}} name: <a href="{{route('profile.show', $comment->guest_id)}}" class="text-decoration-none text-success fw-bold">{{$comment->user->name}}</a>: {{date('m/d/Y D H:i:s', strtotime($comment->created_at))}}
                                </p>
                            </div>
                            <div class="col-2 text-end">
                                @can('admin')
                                    <button class="btn border-0" data-bs-toggle="modal" data-bs-target="#delete-comment-{{$comment->id}}">
                                        <div class="fs-24">
                                            <i class="fa-regular fa-trash-can text-danger"></i>
                                        </div>
                                    </button>
                                @endcan

                                @if (Auth::user()->id !== $comment->guest_id)
                                    <button class="btn border-0" data-bs-toggle="modal" data-bs-target="#report-comment-{{$comment->id}}">
                                        <div class="fs-24">
                                            <i class="fa-solid fa-ban text-danger"></i>
                                            @can('admin')
                                                <label class="text-danger">{{count($comment->reports)}}</label>
                                            @endcan
                                        </div>
                                    </button>
                                @endif

                            </div>
                            @include('thread.modals.delete-comment')
                            @include('thread.modals.report-comment')
                        </div>
                        <div class="px-4 fs-24" id="comment-{{$comments->firstItem() + $loop->index}}">
                            <p>{{$comment->body}}</p>

                            @if ($comment->image)
                                <img src="{{$comment->image}}" alt="{{$comment->id}}" class="comment-img">
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="d-flex justify-content-center">
                {{$comments->links()}}
            </div>

            <div class="card" id="add-comment">
                <form action="{{route('thread.addComment', $thread)}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card-header bg-white p-0">
                        <textarea name="body" id="comment" rows="5" placeholder="Add comment" class="form-control rounded-bottom-0 bg-white border-0"></textarea>

                    </div>
                    <div class="card-body bg-white" id="comment">
                        <label for="image" class="form-label fw-bold">Image File</label>
                        <input type="file" name="image" id="image" class="form-control w-25 d-inline">

                        <input type="submit" value="Add comment" class="btn btn-orange float-end">
                    </div>
                </form>
            </div>
            <div class="text-end">
                @error('body')
                    <p class="text-danger">{{$message}}</p>
                @enderror

                @error('image')
                    <p class="text-danger">{{$message}}</p>
                @enderror
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
