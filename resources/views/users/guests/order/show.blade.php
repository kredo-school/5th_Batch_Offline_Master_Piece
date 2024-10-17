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
                            @foreach ($reserves as $reserve)
                                <div class="row mb-3">
                                    <div class="col-3">
                                        {{-- book image --}}
                                        <div class="text-center">
                                            <a href="{{route('book.show_book', $reserve->book->id)}}"><img src="{{ $reserve->book->image }}" alt="{{$reserve->book->id}}"
                                                    class="border w-100 shadow"></a>
                                        </div>
                                    </div>
                                    <div class="col-6 fs-32">
                                        {{-- book infomation --}}
                                        <p class="fs-32"><a href="{{route('book.show_book', $reserve->book->id)}}"
                                                class="text-decoration-none text-dark">{{ $reserve->book->title }}</a>
                                        </p>
                                        <p class="h4"><a href="#"
                                                class="text-decoration-none text-dark">Author</a></p>

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
                                        <p class="text-danger fs-32 mt-5">¥ {{ number_format($reserve->book->price) }}
                                        </p>
                                    </div>
                                    <div class="col-3 text-end">
                                        {{-- store,amount,delete --}}

                                        {{-- IDを送る --}}
                                        <h4>Store: <a href="{{route('book.store_show', )}}"
                                                class="text-decoration-none text-dark">{{ $reserve->store->name }}</a>
                                        </h4>
                                        <h4>Inventory: {{ $reserve->inventory->stock }}</h4>
                                        <form action="{{ route('order.updateAndDelete') }}" method="post">
                                            @csrf
                                            @method('PATCH')

                                            <input type="number" name="amount[]" id="amount" placeholder="Amount"
                                                min="0" max="{{ $reserve->inventory->stock }}"
                                                value="{{ old('amount'.$loop->index, $reserve->amount) }}"
                                                class="form-control mb-2 mt-4 w-50 text-center d-inline">
                                            @error('amount'.$loop->index)
                                                <p class="text-danger small">{{ $message }}</p>
                                            @enderror

                                            <input type="hidden" name="reserve_id[]" value="{{$reserve->id}}">
                                            <button type="submit" name="action" value="delete-{{$loop->index}}" class="btn btn-danger w-50">Delete</button>
                                    </div>
                                </div>
                                @if (!$loop->last)
                                    <hr>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-3">
                {{-- total --}}
                <div class="card text-center mb-2">
                    <div class="card-header bg-white ">
                        <h1 class="fw-bold">Selected: 4</h1>
                        <h1 class="fw-bold">Total: ¥3,000</h1>
                    </div>
                </div>

                    <button type="submit" name="action" value="update" class="btn btn-warning w-100 p-2">Select Store <i
                            class="fa-solid fa-arrow-right"></i></button>
                </form>
            </div>
        </div>
    </div>
@endsection
