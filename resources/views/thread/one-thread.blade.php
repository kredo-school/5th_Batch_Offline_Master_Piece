<div class="card w-100 fs-24 mb-3">
    <a href="{{route('thread.content', $thread)}}" class="text-decoration-none text-dark">
        <div class="card-header bg-white">
            <div class="row mx-2 align-items-center">
                <div class="col-8 ps-0">
                    <span class="fw-bold">Title: </span>{{$thread->title}}
                </div>
                <div class="col-2 pe-0 text-end text-secondary h5 mb-0">Comment: {{count($thread->comments)}}</div>
                <div class="col-2 h5 text-secondary text-end mb-0">Date: {{date('m/d/Y', strtotime($thread->created_at))}}</div>
            </div>
            <p class="text-secondary small mx-2 mb-0">
                @foreach ($thread->genres as $genre)
                        <span class="me-2">{{$genre->name}}</span>
                @endforeach
            </p>


                @if (Auth::user()->isBookmarked($thread->id))
                    <form action="{{route('thread.bookmarkDestroy', $thread->id)}}" method="post" class="text-end">
                        @csrf
                        @method('DELETE')

                        <button type="submit" name="bookmark" class="btn border-0 fs-24">
                            <i class="fa-solid fa-bookmark"></i>
                        </button>
                    </form>
                @else
                    <form action="{{route('thread.bookmark', $thread)}}" method="post" class="text-end">
                    @csrf
                        <button type="submit" name="bookmark" class="btn border-0 fs-24">
                            <i class="fa-regular fa-bookmark"></i>
                        </button>
                    </form>
                @endif
        </div>
        <div class="card-body bg-white">
            <div class="mx-2">
                <span class="fw-bold">Comment: </span>
                @foreach($thread->comments->take(1) as $comment)
                    {{$comment->body}}
                @endforeach
            </div>
        </div>
    </a>
</div>
