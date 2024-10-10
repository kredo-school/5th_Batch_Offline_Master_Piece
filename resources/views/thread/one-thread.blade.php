<div class="card w-100 fs-24 mb-3">
    <a href="#" class="text-decoration-none text-dark">
        <div class="card-header bg-white">
            <div class="row mx-2 align-items-center">
                <div class="col-8 ps-0">
                    <span class="fw-bold">Title: </span>{{$thread->title}}
                </div>
                <div class="col-2 pe-0 text-end text-secondary h5 mb-0">Comment: {{count($thread->comments)}}</div>
                <div class="col-2 h5 text-secondary text-end mb-0">{{date('M d, Y', strtotime($thread->created_at))}}</div>
            </div>
            <p class="text-secondary small mx-2 mb-0">
                @foreach ($thread->genre_threads as $genre_id)
                    <span class="me-2">{{$genre_id->genre->name}}</span>
                @endforeach
            </p>
        </div>
        <div class="card-body bg-white">
            <div class="mx-2">
                <span class="fw-bold">Comment: </span>
                @foreach($thread->comments as $comment)
                    {{$comment->body}}
                @endforeach
            </div>
        </div>
    </a>
</div>
