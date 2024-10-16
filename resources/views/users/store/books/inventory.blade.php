@extends('layouts.app')

@section('title','Book List')

@section('content')
        <div>
            <form action="{{ route('store.books.search') }}" method="get">
                @csrf
                <div class="row align-items-center">
                    <div class="col-4">
                        <a href="{{url()->previous()}}" class="fw-bold text-decoration-none main-text btn border-0">
                            <div class="h2 fw-semibold">
                                <i class="fa-solid fa-caret-left"></i>
                                <div class="d-inline main-text">Back</div>
                            </div>
                        </a>
                    </div>
                    <div class="col-4">
                        <div class="d-flex justify-content-center" >
                            <form action="{{ route('store.books.search') }}" class="d-flex">
                                @csrf
                                <div class="row ms-auto">
                                    <div class="col pe-0 position-relative">
                                        <input type="text" id="searchInput" name="search" class="form-control rounded"
                                            style="width: 400px" placeholder="Search books...">
                                        <span id="clearButton" class="clearButton" >&times;</span>
                                        <script>
                                            document.addEventListener('DOMContentLoaded', function() {
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
                    <div class="col-4">
                        <div class="text-end w-75">
                            <a href="{{ route('store.orderConfirm') }}" class="btn Goto-inventory pt-3 fs-4"><i class="fa-solid fa-plus"></i> Add</a>
                        </div>
                        {{-- <br><br> --}}
                    </div>
                </div>
            </form>
        </div>

        {{--ーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーー--}}
        <div class="container">
            <div class="row">
                <div class="col-7 mx-auto">
                    <div class="bg-white rounded my-5 ps-5 overflow-auto profile-list"  style="height: 1100px">
                        <h2 class="h1 fw-bold text-grey mt-3">Inventory</h2><br>
                        @if($inventories)
                        @foreach($inventories as $inventory)
                        <div class="row mt-4"><br>
                                <div class="col-3">
                                    <img src="{{ asset('images/649634.png') }}" alt="$book->id" class="shadow search-list-img ordered-img">
                                </div>
                                <div class="col-6 fs-32 ms-5 ps-5">
                                    <div class=>
                                        <p class="fs-32">$inventory->book->title</p>
                                        <p class="h4">$inventory->author->name</p>
                                    </div>
                                    <div class="mt-5">
                                        <form action="" method="post">
                                            @csrf
                                            {{-- if --}}
                                            {{-- <div class="fs24">
                                                Inventory: 10
                                            </div> --}}

                                            <div class="fs24 text-danger">
                                                Inventory: 0
                                            </div>
                                            <input type="number" name="stock" id="stock" class="form-control w-25 float-end">
                                            @error('stock')
                                                <p class="text-danger small">{{$message}}</p>
                                            @enderror

                                        </form>
                                    </div>
                                </div>
                                <div class="col">
                                    <form action="" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn">
                                            <i class="fa-regular fa-trash-can text-danger h2"></i>
                                        </button>
                                    </form>

                                </div>
                            </div>
                            <br><hr>
                            @endforeach
                        @endif
                    </div>
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
