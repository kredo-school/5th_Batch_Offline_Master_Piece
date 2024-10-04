@extends('layouts.app')

@section('title','ordered')

@section('content')
<a href="{{ route('store.orderConfirm') }}" class="fw-bold text-decoration-none main-text btn border-0">
    <div class="h2 fw-semibold">
        <i class="fa-solid fa-caret-left"></i>
        <div class="d-inline main-text">Back</div>
    </div>
</a>
<div class="d-flex justify-content-center">
    <form action="{{ route('store.search') }}" class="d-flex">
        @csrf
        <div class="row ms-auto">
            <div class="col pe-0 position-relative">
                <input type="text" id="searchInput" name="search" class="form-control rounded"
                    style="width: 400px" placeholder="Search books...">
                <span id="clearButton" class="clearButton" style="display: none;">&times;</span>
            </div>
            <div class="col ps-1">
                <button type="submit" class="btn btn-warning search-icon" style="height: 37.3px;">
                    <i class="fa-solid fa-magnifying-glass text-white"></i>
                </button>
            </div>
        </div>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('searchInput');  // 正しいIDを使用
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
    });
</script>
{{--ーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーー--}}
<div class="container">
    <div class="row">
        <div class="col-7 mx-auto">
            <div class="bg-white rounded my-5 px-5 overflow-auto profile-list"  style="height: 1100px">
                <h2 class="h1 fw-bold text-grey mt-3">History</h2><br>
                @for ($i = 0; $i < 5; $i++)
                <div class="row mt-4"><br>
                        <div class="col-3">
                            <img src="{{ asset('images/649634.png') }}" alt="$book->id" class="shadow search-list-img ordered-img">
                        </div>
                        <div class="col-6 fs-32 ms-5 ps-5">
                            <div class=>
                                <p class="fs-32">$book->name</p>
                                <p class="h4">$book->author->name</p>
                            </div>
                            <div class="mt-5">
                                <p class="h2">Stock: $book->inventory->stock</p>
                                <p class="h2">Ordered: </p>
                            </div>
                        </div>
                    </div>
                    <br><hr>
                @endfor
            </div>
        </div>
    </div>

    <div class="text-end w-75">
        <a href="{{ route('store.inventory') }}" class="btn Goto-inventory pt-3 fs-4">Go to Inventory</a>
    </div><br><br>
</div>
@endsection
