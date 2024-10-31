@extends('layouts.app')

@section('title', 'new-order-confirm')

@section('content')
    <a href="{{ url()->previous() }}" class="fw-bold text-decoration-none main-text btn border-0">
        <div class="h2 fw-semibold">
            <i class="fa-solid fa-caret-left"></i>
            <div class="d-inline main-text">Back</div>
        </div>
    </a>

    <!-- メインの addOrUpdateOrders フォーム -->
    <form action="#" method="post" class="d-flex flex-column">
        @csrf

        <div class="row justify-content-center">
            <div class="col-8 mt-1">
                <div class="bg-white rounded my-5 px-5 overflow-auto profile-list" style="height: 1100px">
                    <h2 class="h1 fw-bold text-grey mt-3">Confirm Your Order</h2><br>

                    @foreach ($user->storeOrders as $index => $order)
                        @if ($order->quantity && $order->quantity > 0)
                            <div class="row mt-4">
                                <div class="col-3 mt-3">
                                    <a href="{{ route('book.show_book', $order->book->id) }}" class="text-decoration-none ">
                                        <img src="{{ $order->book->image }}" alt="{{ $order->book->id }}"
                                            class="w-100 shadow">
                                    </a>
                                </div>
                                <div class="col-6 fs-32">
                                    <p>
                                        <a href="{{ route('book.show_book', $order->book->id) }}"
                                            class="text-decoration-none">
                                            <p class="fs-32">{{ $order->book->title }}</p>
                                        </a>
                                        @foreach ($order->book->authors as $author)
                                            <a href="{{ route('book.author_show', $author->id) }}"
                                                class="text-decoration-none text-dark">
                                                <p class="h4">{{ $author->name }}</p>
                                            </a>
                                        @endforeach
                                    </p>
                                    @php
                                        $averageStarCount = $order->book->reviews->avg('star_count');
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
                                    <p class="text-danger fs-32 mt-2">¥ {{ floor($order->book->price) }}</p>
                                </div>
                                <div class="col-3">
                                    <div class="h-75 d-flex flex-column justify-content-between">
                                        <a class="text-danger btn fs-32 p-0 text-end" data-bs-toggle="modal"
                                            data-bs-target="#delete-order-modal-{{ $order->book->id }}">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </a>
                                        <p class="h1 bold">Stock:
                                            {{ $order->book->inventory->first() ? $order->book->inventory->first()->stock : 'No stock data' }}
                                        </p>
                                    </div>

                                    <!-- 数量調整のフィールド -->
                                    <div class="h-25 pt-4">
                                        <input type="hidden" name="orders[{{ $index }}][book_id]"
                                            value="{{ $order->book->id }}">
                                        <div class="row mt-auto">
                                            <div class="col-3 text-end">
                                                <button type="button" class="btn text-danger btn-decrease">
                                                    <i class="fa-solid fa-minus h3"></i></button>
                                            </div>
                                            <div class="col-6">
                                                <input type="number" name="orders[{{ $index }}][quantity]"
                                                    id="quantityInput_{{ $index }}" class="form-control"
                                                    value="{{ old('orders.' . $index . '.quantity', $order->quantity) }}"
                                                    min="1">
                                            </div>
                                            <div class="col-3">
                                                <button type="button" class="btn text-primary btn-increase">
                                                    <i class="fa-solid fa-plus h3"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                        @endif
                    @endforeach
                </div>

                <!-- メインフォームの送信ボタン -->
                <div class="text-end my-5">
                    <button type="submit" class="me-3 p-3 border-0 rounded new-order-confirm-proceed">Proceed to
                        Next</button>
                </div>
            </div>
        </div>
    </form>

    <!-- 削除モーダル群 -->
    @foreach ($user->storeOrders as $order)
        <!-- 各削除モーダル -->
        @include('users.store.books.modals.delete-order')
    @endforeach

    <script>
        document.querySelectorAll('.btn-increase').forEach((button, index) => {
            button.addEventListener('click', function() {
                let quantityInput = document.getElementById(`quantityInput_${index}`);
                let quantity = parseInt(quantityInput.value, 10) || 0;
                quantityInput.value = quantity + 1; // 増加
            });
        });

        document.querySelectorAll('.btn-decrease').forEach((button, index) => {
            button.addEventListener('click', function() {
                let quantityInput = document.getElementById(`quantityInput_${index}`);
                let quantity = parseInt(quantityInput.value, 10) || 1;
                if (quantity > 1) {
                    quantityInput.value = quantity - 1; // 減少
                }
            });
        });
    </script>
@endsection
