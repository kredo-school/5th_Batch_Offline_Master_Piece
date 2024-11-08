@extends('layouts.app')

@section('title', 'Thread Content')

@section('content')
<div class="container-fluid">
    @include('thread.header')

    <div class="row ms-3">
        <div id="comments-section" class="col-10">
            <div class="card w-100 mb-5">
                <div class="card-header bg-white border-bottom-0">
                    <div class="text-end">
                        <a href="{{url()->current(). '?page=' .$latestPage. '#comment-' .count($thread->comments)}}" class="text-secondary">Latest comment <i class="fa-solid fa-arrow-down"></i></a>
                    </div>

                    {{-- title --}}
                    <h1 class="text-danger fw-bold">
                        {{$thread->title}}
                    </h1>
                    <div class="row">
                        <div class="col">
                            <p class="text-secondary mb-0">
                                @if ($thread->genres->isNotEmpty())
                                    Genre:
                                    @foreach ($thread->genres as $genre)
                                        {{$genre->name}}
                                    @endforeach
                                @endif
                            </p>
                        </div>
                        <div class="col-auto">
                            <div class="justify-content-end d-flex">

                                @can('admin')
                                    <button class="btn btn-danger border-0" data-bs-toggle="modal" data-bs-target="#delete-thread-{{$thread->id}}">
                                        Delete thread
                                    </button>
                                    @include('thread.modals.delete-thread')
                                @endcan

                                @if (Auth::user()->isBookmarked($thread->id))
                                    <form action="{{route('thread.bookmarkDestroy', $thread->id)}}" method="post">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" name="bookmark" class="btn border-0 fs-24">
                                            <i class="fa-solid fa-bookmark"></i>
                                        </button>
                                    </form>
                                @else
                                    <form action="{{route('thread.bookmark', $thread)}}" method="post">
                                    @csrf
                                        <button type="submit" name="bookmark" class="btn border-0 fs-24">
                                            <i class="fa-regular fa-bookmark"></i>
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>

                </div>

                <div class="card-body bg-white pt-0">
                    @foreach($comments->take(100) as $comment)
                        <hr>
                        <div class="row">
                            <div class="col-10 fs-5 comment" data-id="{{$comments->firstItem() + $loop->index}}">
                                <p>{{$comments->firstItem() + $loop->index}} name:
                                    <a href="{{route('profile.show', $comment->guest_id)}}" class="text-decoration-none text-success fw-bold">
                                        {{$comment->user->name}}
                                    </a>: {{date('m/d/Y D H:i:s', strtotime($comment->created_at))}}

                                    @if (!$comment->deleted_at)
                                        <a href="#add-comment" onclick="setParentId({{$comments->firstItem() + $loop->index}})" class="btn reply-button">
                                            <i class="fa-solid fa-reply"></i>
                                        </a>
                                    @endif
                                </p>


                            </div>
                            <div class="col-2 text-end">
                                @can('admin')
                                    @if (!$comment->deleted_at)
                                        <button class="btn border-0" data-bs-toggle="modal" data-bs-target="#delete-comment-{{$comment->id}}">
                                            <div class="fs-24">
                                                <i class="fa-regular fa-trash-can text-danger"></i>
                                            </div>
                                        </button>
                                    @endif

                                @endcan

                                @if (Auth::user()->id !== $comment->guest_id)
                                    @if ($comment->deleted_at)
                                        @can('admin')
                                            <div class="fs-24" style="padding-right: 12px">
                                                <i class="fa-solid fa-check text-success"></i>
                                            </div>
                                        @endcan
                                    @else
                                        <button class="btn border-0" data-bs-toggle="modal" data-bs-target="#report-comment-{{$comment->id}}">
                                            <div class="fs-24">
                                                <i class="fa-solid fa-ban text-danger"></i>
                                                @can('admin')
                                                    <label class="text-danger">{{count($comment->reports)}}</label>
                                                @endcan
                                            </div>
                                        </button>
                                    @endif
                                @endif

                            </div>
                            @include('thread.modals.delete-comment')
                            @include('thread.modals.report-comment')
                        </div>
                        <div class="px-4 fs-24" id="comment-{{$comments->firstItem() + $loop->index}}" data-comment-id="{{$comment->id}}">
                            @if($comment->parent_id)

                                @php
                                    $page = ceil($comment->parent_id / 100)
                                @endphp

                                <a href="{{url()->current(). '?page=' .$page. '#comment-' .$comment->parent_id}}" class="text-decoration-none">>>{{$comment->parent_id}}</a>
                            @endif

                            @if ($comment->deleted_at)
                                <p class="text-muted fst-italic h5">This comment was deleted.</p>
                            @else
                                <p>{{$comment->body}}</p>

                                @if ($comment->image)
                                    <img src="{{$comment->image}}" alt="{{$comment->id}}" class="comment-img">
                                @endif

                            @endif



                        </div>
                    @endforeach
                </div>
            </div>

            <div class="d-flex justify-content-center">
                {{$comments->links()}}
            </div>

            <div class="card" >
                <form action="{{route('comment.addComment', $thread)}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card-header bg-white p-0">
                        <textarea name="body" id="add-comment" rows="3" placeholder="Add comment" class="form-control rounded-bottom-0 bg-white border-0 fs-24"></textarea>

                    </div>
                    <div class="card-body bg-white" id="comment">

                        <div class="row align-items-center">
                            <div class="col">
                                <label for="image" class="form-label fw-bold">Image File</label>
                                <input type="file" name="image" id="image" class="form-control w-50 d-inline">
                                <div id="image-info" class="form-text">
                                    <p class="mb-0">Acceptable formats: jpeg, jpg, png, gif only.</p>
                                    <p class="m-0">Maximum file size is 1048kb.</p>
                                </div>
                            </div>
                            <div class="col text-end">
                                <p id="selected-comment-id" class="mb-0 d-inline-block text-end text-primary h4"></p>
                            </div>
                            <div class="col-auto">
                                <input type="hidden" name="thread_id" value="{{$thread->id}}">
                                <input type="hidden" name="parent_id" id="parent_id">
                                <input type="submit" value="Add comment" class="btn btn-orange float-end">
                            </div>
                        </div>
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
            @for ($i = 0; $i < max(1,count($comments)) / 2; $i++)
                <a href="#" class="text-decoration-none text-white">
                    <div class="thread-adv mb-3 bg-adv w-100">
                        <p class="h2">Advertisement</p>
                    </div>
                </a>
            @endfor
        </div>
    </div>
</div>

<script>
// すべての返信ボタンを取得
const replyButtons = document.querySelectorAll('.reply-button');

// 返信ボタンがクリックされたときの処理
replyButtons.forEach(button => {
    button.addEventListener('click', function() {
        // クリックされたボタンの親要素からコメントIDを取得
        const commentElement = this.closest('.comment');
        const commentId = commentElement.getAttribute('data-id');

        // コメントIDを画面に表示
        document.getElementById('selected-comment-id').textContent = `Reply to: ${commentId}`;
    });
});

function setParentId(commentId) {
    // 隠しフィールドにcommentIdをセットする
    document.getElementById('parent_id').value = commentId;
}
</script>
@endsection
