<div class="row justify-content-center mb-3">
    <div class="col-auto"><img src="{{ asset('images/BB2BB7F8-CA14-4C2A-8606-2DA9E432FEB0 copy.png') }}" alt=""
            class="thread-img"></div>
    <div class="col-auto">
        <h1 class="thread-title">Threads about Books</h1>
    </div>
</div>

<div class="row ms-3">
    <div class="col-10">

        <div class="row mb-5">
            <div class="col">

                <div class="row align-items-center">
                    <div class="col">
                        <form id="genreForm" method="get">
                        @csrf
                        <select name="genre_id" id="genreSelect" class="form-select">
                            <option value="">All genres</option>
                            @if (request()->is('thread/home*'))
                                @foreach ($all_genres as $genre)
                                    <option value="{{$genre->id}}" {{$genre_id == $genre->id ? 'selected' : ''}}>{{$genre->name}}</option>
                                @endforeach
                            @elseif(request()->is('thread/content*'))
                                @foreach ($all_genres as $genre)
                                    <option value="{{$genre->id}}">{{$genre->name}}</option>
                                @endforeach
                            @endif

                        </select>
                        </form>
                    </div>
                    <div class="col ps-0">
                        <form action="{{route('thread.home')}}" method="get">
                            @csrf

                                @if ($request->bookmark == 'true')
                                    <button type="submit" class="btn btn-warning">
                                        Bookmarks <i class="fa-solid fa-check"></i>
                                    </button>
                                @else
                                    <input type="hidden" name="bookmark" value="true">
                                    <button type="submit" class="btn btn-outline-warning">
                                        Bookmarks
                                    </button>
                                @endif
                        </form>
                    </div>
                </div>


            </div>

            <div class="col">
                <form action="{{route('thread.home')}}" method="get" style="width: 500px" class="d-flex">
                    @csrf
                    <div class="row ms-auto">
                        <div class="col pe-0 position-relative">
                            <input type="text" id="searchInput" name="search" class="form-control rounded searchInput"
                                style="width: 400px" placeholder="Search threads..." value="{{$request->search}}">
                                <span id="clearButton" class="clearButton">&times;</span>
                        </div>
                        <div class="col ps-1">
                            <button type="submit" class="btn btn-warning search-icon">
                                <i class="fa-solid fa-magnifying-glass text-white"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>

    <div class="col-2">
        @if(request()->is('thread/content/*'))
            <div class="text-end">
                <a href="#add-comment" class=" text-dark h3">
                    <i class="fa-solid fa-pen-to-square"></i> Add comment
                </a>
            </div>
        @endif
    </div>
</div>


{{-- sort in the same page --}}
<script>
    document.getElementById('genreSelect').addEventListener('change', function() {
        const genreId = this.value;
        if (genreId) {
            window.location.href = `/thread/home?genre_id=${genreId}`; // ジャンルIDをクエリパラメータに追加してURLを生成
        } else {
            window.location.href = '/thread/home'; // ジャンルが未選択の場合は全てのスレッドを表示するページに戻る
        }
    });
</script>
