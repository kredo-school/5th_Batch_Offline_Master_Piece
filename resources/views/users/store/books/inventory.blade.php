@extends('layouts.app')

@section('title', 'Book List')

@section('content')
    <div>
        <!-- 検索フォーム -->
        <?php
        function highlightKeyword($text, $keyword)
        {
            // 正規表現で指定されたキーワードをハイライト（例：<mark>タグで囲む）
            return preg_replace('/(' . preg_quote($keyword, '/') . ')/i', '<mark>$1</mark>', $text);
        }
        
        ?>
        <div class="d-flex justify-content-center mt-3">
            <form action="{{ route('store.books.search') }}" class="d-flex">
                @csrf
                <div class="row ms-auto">
                    <div class="col pe-0 position-relative">
                        <input type="text" id="searchInput" name="search" class="form-control rounded" style="width: 400px"
                            placeholder="Search books...">
                        <span id="clearButton" class="clearButton">&times;</span>
                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                const searchInput = document.getElementById('searchInput');
                                const clearBtn = document.getElementById('clearButton');

                                // 入力フィールドのイベントリスナーを設定
                                searchInput.addEventListener('input', function() {
                                    if (searchInput.value.length > 0) {
                                        clearBtn.style.display = 'inline'; // テキストがあるときはバツ印を表示
                                    } else {
                                        clearBtn.style.display = 'none'; // テキストがないときは非表示
                                    }
                                });

                                // バツ印をクリックしたときの処理
                                clearBtn.addEventListener('click', function() {
                                    searchInput.value = ''; // 入力フィールドをクリア
                                    clearBtn.style.display = 'none'; // バツ印を非表示
                                    searchInput.focus(); // フィールドにフォーカスを戻す
                                });
                            });
                        </script>

                    </div>
                    <div class="col ps-1">
                        <button type="submit" class="btn btn-warning search-icon" style="height: 37.3px;">
                            <i class="fa-solid fa-magnifying-glass text-white"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Inventoryと発注数追加用の全体フォーム -->
    <div class="container">
        <div class="row">
            <div class="col-7 mx-auto">
                <form action="{{ route('store.addToNewconfirm') }}" method="post">
                    @csrf
                    <div class="bg-white rounded my-5 ps-5 overflow-auto profile-list" style="height: 1100px">
                        <h2 class="h1 fw-bold text-grey mt-3">Inventory</h2><br>
                        @if ($all_inventories)

                            <!-- Inventoryのループ -->
                            @foreach ($all_inventories as $inventory)
                                @if ($inventory->book)
                                    <div class="row mt-4">
                                        <div class="col-3">
                                            <a href="{{ route('store.bookInformation', $inventory->book->id) }}"
                                                class="text-decoration-none">
                                                <img src="{{ $inventory->book->image }}" alt="{{ $inventory->book_id }}"
                                                    class="shadow search-list-img ordered-img">
                                            </a>
                                        </div>

                                        <div class="col-6 fs-32 ms-5 ps-5">
                                            <p class="fs-32">{{ $inventory->book->title }}</p>
                                            <p class="h3">{{ $inventory->book->author_name }}</p>
                                            <div class="fs24 text-danger">Stock: {{ $inventory->stock }}</div>

                                            <!-- 各bookごとのフォーム -->

                                            <!-- 発注数の入力 -->
                                            <div class="mt-4">
                                                <label for="quantity" class="form-label fs-5 me-0">Enter order
                                                    quantity</label>
                                                <input type="number" name="amount[]"
                                                    class="form-control w-25 float-end me-3" value="{{ old('amount') }}"
                                                    min="1">
                                                <input type="hidden" name="book_id[]" value="{{ $inventory->book_id }}">
                                            </div>

                                            @error('amount')
                                                <p class="text-danger small">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="col-2">
                                            <!-- 削除ボタンmodal -->
                                            <a class="text-danger btn fs-32 p-0 text-end" data-bs-toggle="modal"
                                                data-bs-target="#delete-order-modal-{{ $inventory->book_id }}">
                                                <i class="fa-solid fa-trash-can mt-2"></i>
                                            </a>
                                        </div>
                                    </div>
                                @endif

                                @if (!$loop->last)
                                    <hr>
                                @endif
                            @endforeach
                            <br>
                        @endif
                    </div>
                    <!-- 更新ボタン -->
                    <div class="ms-auto text-end">
                        <button type="submit" class="btn Goto-inventory pt-3 fs-4" name="action" value="update">
                            <i class="fa-solid fa-plus"></i> Add
                        </button>
                    </div>
                </form>

                <!-- 削除モーダル群 -->
                @foreach ($all_inventories as $inventory)
                    <!-- 各削除モーダル -->
                    @if ($inventory->book)
                        @include('users.store.books.modals.delete-inventory')
                    @endif
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
        searchInput.focus(); // フィールドにフォーカスを戻す
    });
</script>
