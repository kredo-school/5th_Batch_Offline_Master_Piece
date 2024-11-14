@extends('layouts.app')

@section('title', 'Guest Comment')


@section('content')

    @include('users.guests.profile.contents.header')

    <div class="row justify-content-center mt-2">
        <div class="col-8 mt-3">
            <div class="p-4 row">
                <div class="col-md-6 col-lg-3 col-12 text-center">
                    <a href="{{ route('profile.show', $user->id) }}"
                        class="fw-bold text-decoration-none fs-40 text-grey">Review</a>
                </div>
                @if (Auth::id() == $user->id || Auth::user()->role_id == 1)
                    <div class="col-md-6 col-lg-3 col-12 text-center">
                        <a href="{{ route('profile.bookmark', $user->id) }}"
                            class="fw-bold text-decoration-none fs-40 text-grey">Bookmark</a>
                    </div>
                    <div class="col-md-6 col-lg-3 col-12 text-center">
                        <a href="{{ route('profile.order', $user->id) }}"
                            class="fw-bold text-decoration-none fs-40 text-grey">Order</a>
                    </div>
                    <div class="col-md-6 col-lg-3 col-12 text-center">
                        <a href="{{ route('profile.comment', $user->id) }}"
                            class="fw-bold text-decoration-none fs-40 text-dark">Comment</a>
                    </div>
                @endif
            </div>
            <div class="bg-white rounded mt-2 px-5 overflow-auto profile-list">
                <div class="row">
                    <div class="col-8">
                        <h2 class="h1 fw-bold text-grey mt-3">Comment</h2>
                    </div>
                    {{-- order list --}}
                    <div class="col-4">
                        <form method="GET" id="sortForm" action="{{ route('profile.sort', $user->id) }}">
                            @csrf
                            <select name="sort" id="sortSelect" class="form-select mt-4">
                                <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Latest</option>
                                <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Oldest</option>
                                @can('admin')
                                    <option value="reported" {{ request('sort') == 'reported' ? 'selected' : '' }}>Reported
                                </option>
                                @endcan
                            </select>
                        </form>
                    </div>
                </div>

                {{-- comment list --}}
                @if ($user->comments->isEmpty())

                    <div class="d-flex align-items-center justify-content-center" style="height: 400px;">
                        <p class="text-center h1">No data yet</p>
                    </div>
                @else
                    @foreach ($comments as $comment)
                        <div class="row mt-5">
                            <hr>
                            <div class="col-10 fs-24">
                                <h3>Thread: <a href="{{route('thread.content',$comment->thread)}}"
                                        class="text-decoration-none text-primary">{{ $comment->thread->title }}</a></h3>
                                <p>name: <a href="{{ route('profile.comment', $user->id) }}"
                                        class="text-decoration-none text-success fw-bold">{{ $user->name }}</a>:
                                    {{ $comment->created_at }}</p>
                            </div>
                            <div class="col-2 fs-24 text-end">
                                @can('admin')
                                    <i class="fa-solid fa-ban text-danger"></i>
                                    <label class="text-danger">{{ count($comment->reports) }}</label><br>
                                    <a class="text-danger btn fs-24 p-0" data-bs-toggle="modal"
                                        data-bs-target="#delete-comment-{{ $comment->id }}">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </a>
                                @endcan
                            </div>
                            <!-- Include the modal here -->
                            @include('users.guests.profile.modal.delete')

                        </div>
                        <div class="px-4 fs-24 wrap-text">
                            <p>{{ $comment->body }}</p>
                        </div>
                    @endforeach



                @endif


            </div>
        </div>


    </div>


    <script>
        document.getElementById('sortSelect').addEventListener('change', function() {
            document.getElementById('sortForm').submit();
        });
    </script>

@endsection
