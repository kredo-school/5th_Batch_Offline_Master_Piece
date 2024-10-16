@extends('layouts.app')

@section('title', 'Store Home')

@section('content')

    <div class="container">
        <div class="mt-5 d-flex justify-content-center">
            <form method="get" action="{{ route('store.books.search') }}" class="d-flex">
                @csrf
                <div class="row ms-auto">
                    <div class="col pe-0 position-relative">
                        <input type="text" id="searchInput" name="search" class="form-control rounded"
                            style="width: 400px" placeholder="Search books...">
                        <span id="clearButton" class="clearButton" >&times;</span>
                        <script>
                            // 正しいIDを取得
                            const searchInput = document.getElementById('searchInput');
                            const clearBtn = document.getElementById('clearButton');

                            // 入力フィールドのイベントリスナーを設定
                            searchInput.addEventListener('input', function() {
                                if (searchInput.value.length > 0) {
                                    clearBtn.style.display = 'inline';  // テキストがあるときはバツ印を表示
                                } else {
                                    clearBtn.style.display = 'none';    // テキストがないときは非表示
                                }
                            });

                            // バツ印をクリックしたときの処理
                            clearBtn.addEventListener('click', function() {
                                searchInput.value = '';  // 入力フィールドをクリア
                                clearBtn.style.display = 'none';  // バツ印を非表示
                                searchInput.focus();  // フィールドにフォーカスを戻す
                            });
                        </script>
                    </div>
                    <div class="col ps-1">
                        <button type="submit" class="btn btn-warning search-icon">
                            <i class="fa-solid fa-magnifying-glass text-white"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <div style="margin-inline-start: 5%;">
            <div class="row m-5">
                <div class="col-4">
                    <a href="{{ route('store.cashier') }}" class="store-home-button">Cashier</a>
                </div>
                <div class="col-4">
                    <a href="{{ route('store.reservationList') }}" class="store-home-button">Reservations</a>
                </div>
                <div class="col-4">
                    <a href="{{ route('store.bookList') }}" class="store-home-button">Book List</a>
                </div>
            </div>
            <div class="row m-5">
                <div class="col-4">
                    <a href="{{ route('store.analysis') }}" class="store-home-button">Analysis</a>
                </div>
                <div class="col-4">
                    <a href="{{ route('store.inventory') }}" class="store-home-button">Inventory</a>
                </div>
                <div class="col-4">
                    <a href="{{ route('store.storeNewConfirmShow') }}" class="store-home-button">Order</a>
                </div>
            </div>
        </div>
    </div>
    <style>
        .clearButton {
            display: none;
            cursor: pointer;
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 18px;
            color: #757B9D;
        }

        .clearButton:hover {
            color: #333;
        }
    </style>

@endsection
