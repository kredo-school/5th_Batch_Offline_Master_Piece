@extends('layouts.app')

@section('title', 'Order Confirm')

@section('content')
    {{-- Back button --}}
    <div>
        <a href="{{ url()->previous() }}" class="fw-bold text-decoration-none main-text btn border-0">
            <div class="h2 fw-semibold">
                <i class="fa-solid fa-caret-left"></i>
                <div class="d-inline main-text">Back</div>
            </div>
        </a>
    </div>

    <div class="container">
        <h1 class="text-center fw-bold display-5 mb-5">Double-check your order confirmation</h1>
        <div class="row">
            <div class="col-8 mx-auto">
                <div class="h1 fw-bold">
                    <div class="main-text">Selected Order</div>
                </div>

                {{-- Selected Store --}}
                @foreach ($stores as $store)
                    <div class="card mb-5">
                        <div class="card-header bg-white border-bottom-0 d-inline">
                            <div class="row h2 mb-3">
                                <div class="col">
                                    <i class="fa-solid fa-store"></i>
                                    <div class="ms-auto d-inline">
                                        Store: <a href="#"
                                            class="text-decoration-none main-text">{{ $store->name }}</a>
                                    </div>
                                </div>
                                <div class="col text-end">Receiving Date:
                                    <span class="main-text">
                                        @foreach ($store->inventories as $inventory)
                                            @if ($inventory->stock === 0)
                                                3 days later
                                            @else
                                                @if ($loop->last)
                                                    Right now
                                                @endif
                                            @endif
                                        @endforeach
                                    </span>
                                </div>
                            </div>
                        </div>

                        @foreach ($reserves as $reserve)
                            @if ($store->id == $reserve->store_id)
                                <div class="card-body bg-white">
                                    <hr>
                                    <div class="row mb-3">
                                        <div class="col-3">
                                            {{-- book image --}}
                                            <div class="text-center">
                                                <a href="{{ route('book.show_book', $reserve->book->id) }}"><img
                                                        src="{{ $reserve->book->image }}" alt="{{ $reserve->book->id }}"
                                                        class="border w-100 shadow"></a>
                                            </div>
                                        </div>
                                        <div class="col-6 fs-32">
                                            {{-- book infomation --}}
                                            <p class="fs-32"><a href="{{ route('book.show_book', $reserve->book->id) }}"
                                                    class="text-decoration-none text-dark">{{ $reserve->book->title }}</a>
                                            </p>
                                            <p class="h4">
                                                <a href="#" class="text-decoration-none text-dark">
                                                    @foreach ($reserve->book->authors as $author)
                                                        {{ $author->name }}
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
                                            <p class="text-danger fs-32 mt-5">¥ <span class="price"
                                                    data-price="{{ $reserve->book->price }}">{{ number_format($reserve->book->price) }}</span>
                                            </p>
                                        </div>
                                        <div class="col-3 d-flex align-items-end ps-0">

                                            <div class="d-block w-100 me-3">
                                                <div class="row h3 mb-3">
                                                    <div class="col">Stock:</div>
                                                    <div class="col main-text text-end">{{ $reserve->inventory->stock }}
                                                    </div>
                                                </div>
                                                <div class="row h3">
                                                    <div class="col">Amount:</div>
                                                    <div class="col main-text text-end">{{ $reserve->amount }}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                @endforeach


                <div class="card mb-5 mt-5">
                    <div class="card-header h1 border-bottom-0 bg-white">
                        <div class="main-text">
                            <div class="h1 fw-bold">Total</div>
                        </div>
                    </div>
                    <div class="card-body bg-white">
                        <table class="table fs-24 text-center mb-4">
                            <thead class="fs-32">
                                <th class="bg-white">Store</th>
                                <th class="bg-white">Amount</th>
                                <th class="bg-white">Subtotal Price</th>
                            </thead>
                            <tbody>
                                @foreach ($stores as $store)
                                    <tr>
                                        <td class="bg-white"><span class="main-text">{{ $store->name }}</span></td>
                                        <td class="bg-white">

                                            @foreach ($reserves as $reserve)
                                                @if ($store->id == $reserve->store_id)
                                                    @php
                                                        $subtotal_amount += $reserve->amount;
                                                        $subtotal_price += $reserve->amount * $reserve->book->price;
                                                    @endphp
                                                @endif
                                            @endforeach
                                            <span class="main-text">{{ $subtotal_amount }}</span>
                                        </td>
                                        <td class="bg-white"><span
                                                class="main-text">¥{{ number_format($subtotal_price) }}</span></td>
                                    </tr>
                                    @php
                                        $total_price += $subtotal_price;
                                        $subtotal_amount = 0;
                                        $subtotal_price = 0;
                                    @endphp
                                @endforeach

                            </tbody>
                        </table>
                        <div class="text-end me-5 display-5 fw-bold">
                            Total: ¥{{ number_format($total_price) }}
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col text-end">
                        <a href="{{ url()->previous() }}" class="btn btn-outline-secondary w-50 p-3">
                            <div class="h3 m-0"><i class="fa-solid fa-arrow-left"></i> Back</div>
                        </a>
                    </div>
                    <div class="col">
                        <form action="{{ route('order.reserve') }}" method="post">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn btn-orange w-50 p-3">
                                <div class="h3 m-0">Reserve <i class="fa-solid fa-arrow-right"></i></div>
                            </button>
                        </form>
                    </div>
                </div>

            </div>

        </div>
    </div>
@endsection
