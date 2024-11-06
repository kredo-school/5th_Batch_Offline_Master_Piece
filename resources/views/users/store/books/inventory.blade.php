@extends('layouts.app')

@section('title','Book List')

@section('content')
<div>
    <!-- 検索フォーム -->
    <form action="{{ route('store.books.search') }}" method="get">
        @csrf
        <div class="row align-items-center">
            <div class="col-4">
                <a href="{{route('store.bookList')}}" class="fw-bold text-decoration-none main-text btn border-0">
                    <div class="h2 fw-semibold">
                        <i class="fa-solid fa-caret-left"></i>
                        <div class="d-inline main-text">Back</div>
                    </div>
                </a>
            </div>
            <div class="col-4">
                <div class="d-flex justify-content-center">
                    <div class="row ms-auto">
                        <div class="col pe-0 position-relative">
                            <input type="text" id="searchInput" name="search" class="form-control rounded" style="width: 400px" placeholder="Search books...">
                            <span id="clearButton" class="clearButton">&times;</span>
                        </div>
                        <div class="col ps-1">
                            <button type="submit" class="btn btn-warning search-icon" style="height: 37.3px;">
                                <i class="fa-solid fa-magnifying-glass text-white"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<!-- Inventoryと発注数追加用の全体フォーム -->
<div class="container">
    <div class="row">
        <div class="col-7 mx-auto">
            <form action="{{ route('store.addToNewconfirm') }}" method="post">
            @csrf
                <div class="bg-white rounded my-5 ps-5 overflow-auto profile-list" style="height: 1100px">
                    <h2 class="h1 fw-bold text-grey mt-3">Inventory</h2><br>
                    @if($all_inventories)

                    <!-- Inventoryのループ -->
                    @foreach($all_inventories as $inventory)
                        <div class="row mt-4">
                            <div class="col-3">
                                <a href="{{ route('store.bookInformation', $inventory->book->id)}}" class="text-decoration-none">
                                <img src="{{$inventory->book->image}}" alt="{{$inventory->book_id}}" class="shadow search-list-img ordered-img">
                                </a>
                            </div>

                            <div class="col-6 fs-32 ms-5 ps-5">
                                <p class="fs-32">{{$inventory->book->title}}</p>
                                <p class="h4">{{$inventory->book->author_name}}</p>
                                <div class="fs24 text-danger">Stock: {{$inventory->stock}}</div>

                                <!-- 各bookごとのフォーム -->
                                

                                    <!-- 発注数の入力 -->
                                    <input type="number" name="amount[]" class="form-control w-25 float-end" value="{{ old('amount') }}" min="1">
                                    <input type="hidden" name="book_id[]" value="{{ $inventory->book_id }}">

                                    @error('amount')
                                        <p class="text-danger small">{{$message}}</p>
                                    @enderror

                                     <!-- 削除ボタンmodal -->
                                    <a class="text-danger btn fs-32 p-0 text-end" data-bs-toggle="modal"
                                    data-bs-target="#delete-order-modal-{{ $inventory->book_id }}">
                                    <i class="fa-solid fa-trash-can"></i>
                                    </a>

                                    
                            </div>
                        </div>
                        @if (!$loop->last)
                        <hr>
                        @endif
                    @endforeach
                    <br>
                    @endif
                </div>
                <!-- 更新ボタン -->
                <div class="ms-auto">
                <button type="submit" class="btn Goto-inventory pt-3 fs-4" name="action" value="update">
                    <i class="fa-solid fa-plus"></i> Add
                </button>
                </div>
            </form>

              <!-- 削除モーダル群 -->
    @foreach ($all_inventories as $inventory)
    <!-- 各削除モーダル -->
    @include('users.store.books.modals.delete-inventory')
    @endforeach

        </div>
    </div>
</div>


@endsection

<script>
    const searchInput = document.getElementById('searchInput');
    const clearButton = document.getElementById('clearButton');

    // 入力時にクリアボタンの表示・非表示を切り替える
    searchInput.addEventListener('input', function() {
        if (searchInput.value) {
            clearButton.style.display = 'inline';
        } else {
            clearButton.style.display = 'none';
        }
    });

    // クリアボタンを押すと検索フィールドをクリア
    clearButton.addEventListener('click', function() {
        searchInput.value = '';
        clearButton.style.display = 'none';
        searchInput.focus();  // フィールドにフォーカスを戻す
    });
</script>
