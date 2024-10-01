@extends('layouts.app')

@section('title','ordered')

@section('content')

<div class="mt-4 d-flex justify-content-center">
    <form action="#" method="post" style="width: 500px;">
        @csrf
        <div class="row">
            <div class="col pe-0 position-relative">
                <input type="text" id="searchInput" name="search" class="form-control form-control-sm rounded" placeholder=" Search books..." style="width: 400px;">
                <button type="button" id="clearButton" class="btn btn-sm position-absolute end-0 top-50 translate-middle-y rounded" style="display: none; right: 30px;">
                    x
                </button>
            </div>
            <div class="col ps-1">
                <button type="submit" class="btn btn-warning btn-sm search-icon">
                    <i class="fa-solid fa-magnifying-glass text-white"></i>
                </button>
            </div>
        </div>
    </form>
</div>

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
        <a href="#" class="btn Goto-inventory pt-3 fs-4">Go to Inventory</a>
    </div><br><br>
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
