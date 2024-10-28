@extends('layouts.app')

@section('title', 'Order Show')

@section('content')
    <div class="container">
        <div class="row mt-5">
            <div class="col-9">

                <div class="card ms-5">
                    <div class="card-body card-size overflow-auto bg-white">
                        <h1 class="main-text fw-bold mb-3">Order Status</h1>
                        <div class="mx-3">
                            @forelse (Auth::user()->reserves as $reserve)
                                <div class="row mb-3">
                                    <div class="col-3">
                                        {{-- book image --}}
                                        <div class="text-center">
                                            <a href="{{route('book.show_book', $reserve->book->id)}}"><img src="{{ $reserve->book->image }}" alt="{{$reserve->book->id}}"
                                                    class="w-75 shadow img-list"></a>
                                        </div>
                                    </div>
                                    <div class="col-6 fs-32">
                                        {{-- book infomation --}}
                                        <p class="fs-32"><a href="{{route('book.show_book', $reserve->book->id)}}"
                                                class="text-decoration-none text-dark">{{ $reserve->book->title }}</a>
                                        </p>
                                        <p class="h4">
                                            <a href="#"class="text-decoration-none text-dark">
                                                @foreach ($reserve->book->authors as $author)
                                                    {{$author->name}}
                                                @endforeach
                                            </a>
                                        </p>

                                        @php
                                            $averageStarCount = $reserve->book->reviews->avg('star_count');
                                            $fullStars = floor($averageStarCount); // 満点の数
                                            $halfStar = $averageStarCount - $fullStars >= 0.1; // 半点があるか
                                            $emptyStars = 5 - $fullStars - ($halfStar ? 1 : 0); // 残りの星
                                        @endphp

                                        {{-- 満点の星を表示 --}}
                                        @for ($i = 0; $i < $fullStars; $i++)
                                            <i class="fa-solid fa-star text-warning"></i>
                                        @endfor

                                        {{-- 半点の星を表示 --}}
                                        @if ($halfStar)
                                            <i class="fa-solid fa-star-half-stroke text-warning"></i>
                                        @endif

                                        {{-- 未満の星を表示 --}}
                                        @for ($i = 0; $i < $emptyStars; $i++)
                                            <i class="fa-regular fa-star text-warning"></i>
                                        @endfor

                                        {{ number_format($averageStarCount, 1) }}/5.0
                                        <p class="text-danger fs-32 mt-5">¥ <span class="price" data-price="{{$reserve->book->price}}">{{number_format($reserve->book->price)}}</span>
                                        </p>
                                    </div>
                                    <div class="col-3 text-end">
                                        {{-- store,quantity,delete --}}

                                        {{-- IDを送る --}}
                                        <h4>Store: <a href="{{route('book.store_show', $reserve->store->id)}}"
                                                class="text-decoration-none text-dark">{{ $reserve->store->name }}</a>
                                        </h4>
                                        <h4>Inventory: {{ $reserve->inventory->stock }}</h4>
                                        <form action="{{ route('order.updateAndDelete') }}" method="post">
                                            @csrf
                                            @method('PATCH')

                                            <input type="number" name="quantity[]" id="quantity" placeholder="quantity"
                                                min="0" max="30"
                                                value="{{ old('quantity'.$loop->index, $reserve->quantity) }}"
                                                class="form-control mb-5 mt-4 w-50 text-center d-inline quantity">
                                            @error('quantity'.$loop->index)
                                                <p class="text-danger small">{{ $message }}</p>
                                            @enderror

                                            <input type="hidden" name="reserve_id[]" value="{{$reserve->id}}">
                                            <button type="submit" name="action" value="delete-{{$loop->index}}" class="btn w-50">
                                                <div class="fs-24">
                                                    <i class="fa-regular fa-trash-can text-danger"></i>
                                                </div>
                                            </button>
                                    </div>
                                </div>
                                @if (!$loop->last)
                                    <hr>
                                @endif

                                @empty
                                    <p class="text-danger fs-24 text-center mt-5">Nothing added yet</p>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-3">
                {{-- total --}}
                @if (Auth::user()->reserves->isNotEmpty())
                    <div class="card text-center mb-2">
                        <div class="card-header bg-white ">
                            <h1 class="fw-bold">Selected: <span id="total-quantity">0</span></h1>
                            <h1 class="fw-bold">Total: <span id="total-price">0</span></h1>
                        </div>
                    </div>

                        <button type="submit" name="action" value="update" class="btn btn-warning w-100 p-2">Select Store <i
                                class="fa-solid fa-arrow-right"></i></button>
                    </form>
                @endif
            </div>

        </div>
    </div>
@endsection

<script>
document.addEventListener('DOMContentLoaded', function() {
    // 本の金額や数量を取得
    const quantities = document.querySelectorAll('.quantity');
    const prices = document.querySelectorAll('.price');
    const totalPriceElement = document.getElementById('total-price');
    const totalQuantityElement = document.getElementById('total-quantity'); // 合計数量を表示する要素

    // 金額をフォーマットする関数
    function numberFormat(value) {
        return value.toLocaleString('ja-JP'); // カンマ区切り形式で日本の通貨形式に
    }

    // 金額を計算する関数
    function calculateTotal() {
        let total = 0;
        let totalQuantity = 0; // 合計数量の初期化

        quantities.forEach((quantityElement, index) => {
            const price = parseInt(prices[index].getAttribute('data-price')) || 0; // data-priceから取得
            const quantityValue = parseInt(quantityElement.value) || 0; // NaNの場合0にする
            total += price * quantityValue; // 金額を合計に追加
            totalQuantity += quantityValue; // 数量を合計に追加
        });

        // 合計金額と合計数量をフォーマットして更新
        totalPriceElement.innerText = `¥ ${numberFormat(total)}`;
        totalQuantityElement.innerText = totalQuantity; // 合計数量を表示
    }

    // 数量が変更されたときに金額を計算する
    quantities.forEach(quantity => {
        quantity.addEventListener('input', calculateTotal);
    });

    // 初期計算を実行
    calculateTotal();
});
</script>
