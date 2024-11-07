@extends('layouts.app')

@section('title','ordered')

@section('content')

<div class="d-flex justify-content-center">
    <form action="{{ route('store.books.search') }}" class="d-flex">
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
            <div class="bg-white rounded my-5 px-5 overflow-auto profile-list " style="height: 1100px">
                <h2 class="h1 fw-bold text-grey mt-4">History</h2><br>


                @if($all_inventories)
                @foreach ($all_inventories as $inventory)
                    @if ($inventory->stock && $inventory->stock > 0)
                        <div class="row mt-4">
                            <div class="col-3 mt-4">
                                <span class="pb-0">Order date</span>
                                <p class="mt-0 pt-0">{{$inventory->updated_at}}</p>
                                <p class="mt-5"><a href="{{ route('book.show_book', $inventory->book->id) }}" class="text-decoration-none">
                                    <img src="{{ $inventory->book->image }}" alt="{{ $inventory->book->id }}"
                                        class="w-100 shadow">
                                </a></p>
                                <p class="h2 mt-5 ms-1 text-danger">Stock:
                                    {{ $inventory->book->inventory->first() ? $inventory->book->inventory->first()->stock : 'No stock data' }}
                                </p>
                            </div>
                            <div class="col-9 ps-5 fs-32 ">
                                <p>
                                    <a href="{{ route('book.show_book', $inventory->book->id) }}"
                                        class="text-decoration-none">
                                        <p class="fs-32">{{ $inventory->book->title }}</p>
                                    </a>
                                    @foreach ($inventory->book->authors as $author)
                                        <a href="{{ route('book.author_show', $author->id) }}"
                                            class="text-decoration-none text-dark">
                                            <p class="h4">{{ $author->name }}</p>
                                        </a>
                                    @endforeach
                                </p>
                                @php
                                    $averageStarCount = $inventory->book->reviews->avg('star_count');
                                    $fullStars = floor($averageStarCount);
                                    $halfStar = $averageStarCount - $fullStars >= 0.1;
                                    $emptyStars = 5 - $fullStars - ($halfStar ? 1 : 0);
                                @endphp

                                {{-- 星評価の表示 --}}
                                @for ($i = 0; $i < $fullStars; $i++)
                                    <i class="fa-solid fa-star text-warning"></i>
                                @endfor
                                @if ($halfStar)
                                    <i class="fa-solid fa-star-half-stroke text-warning"></i>
                                @endif
                                @for ($i = 0; $i < $emptyStars; $i++)
                                    <i class="fa-regular fa-star text-warning"></i>
                                @endfor

                                {{ number_format($averageStarCount, 1) }}/5.0
                                <p class="text-danger fs-32 mt-2">¥ {{ floor($inventory->book->price) }}</p>
                            </div>
                            {{-- <div class="col-3">
                                <div class="h-75 d-flex flex-column justify-content-between">
                                    <p class="h2">Stock:
                                        {{ $inventory->book->inventory->first() ? $inventory->book->inventory->first()->stock : 'No stock data' }}
                                    </p>
                                </div>

                            </div> --}}
                        </div>
                        <hr>
                    @endif
                @endforeach
                @endif
            </div>
        </div>
    </div>

    <div class="text-end w-75">
        <a href="{{ route('store.inventory') }}" class="btn Goto-inventory pt-3 fs-4">Go to Inventory</a>
    </div><br><br>
</div>
@endsection
