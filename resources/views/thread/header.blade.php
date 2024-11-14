<div class="row justify-content-center mb-3 text-center">
    <div class="col-auto"><img src="{{ asset('images/BB2BB7F8-CA14-4C2A-8606-2DA9E432FEB0 copy.png') }}" alt=""
            class="thread-img"></div>
    <div class="col-auto">
        <h1 class="thread-title">Threads about Books</h1>
    </div>
</div>

<div class="row ms-3">
    <div class="col-12 col-md-10">

        <div class="row mb-5">
            <div class="col-12 col-md-6">

                <div class="row align-items-center">
                    <div class="col-12 col-md-6 mb-2 mb-md-0">
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
                    <div class="col-12 col-md-6 text-md-start text-center">
                        <form action="{{route('thread.home')}}" method="get">
                            @csrf
                            @if ($request->bookmark == 'true')
                                <button type="submit" class="btn btn-warning w-md-100 w-md-auto">
                                    Bookmarks <i class="fa-solid fa-check"></i>
                                </button>
                            @else
                                <input type="hidden" name="bookmark" value="true">
                                <button type="submit" class="btn btn-outline-warning w-md-100 w-md-auto">
                                    Bookmarks
                                </button>
                            @endif
                        </form>
                    </div>
                </div>

            </div>

            <div class="col-12 col-md-6">
                <form action="{{route('thread.home')}}" method="get" class="d-flex flex-column flex-md-row align-items-stretch align-items-md-center">
                    @csrf
                    <div class="flex-grow-1 position-relative">
                        <input type="text" id="searchInput" name="search" class="form-control rounded searchInput"
                            placeholder="Search threads..." value="{{old('search', $request->search)}}">
                        <span id="clearButton" class="clearButton">&times;</span>
                    </div>
                    <button type="submit" class="btn btn-warning mt-2 mt-md-0 ms-md-2">
                        <i class="fa-solid fa-magnifying-glass text-white"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>

    <div class="col-12 col-md-2 text-end text-md-start mt-3 mt-md-0">
        @if(request()->is('thread/content/*'))
            <a href="#add-comment" class="text-dark h3">
                <i class="fa-solid fa-pen-to-square"></i> Add comment
            </a>
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
