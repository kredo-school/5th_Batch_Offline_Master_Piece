@extends('layouts.app')

@section('title','new-order-confirm')

@section('content')
<div class="row justify-content-center">
    <div class="col-8 mt-1">
        <div class="bg-white rounded my-5 px-5 overflow-auto profile-list"  style="height: 1100px">
            <h2 class="h1 fw-bold text-grey mt-3">Confirm and Add New Order Books</h2><br>

            @for ($i = 0; $i < 3; $i++)
            <div class="row mt-4"><br>
                    <p class="text-muted">Sep.12.2024</p>
                    <div class="col-3">
                        <img src="{{ asset('images/649634.png') }}" alt="$book->id" class="w-100 shadow search-list-img">
                    </div>
                    <div class="col-6 fs-32">
                        <p>
                            <p class="fs-32">$book->name</p>
                            <p class="h4">$book->author->name</p>
                            <i class="fa-solid fa-star text-warning"></i>
                            <i class="fa-solid fa-star text-warning"></i>
                            <i class="fa-solid fa-star text-warning"></i>
                            <i class="fa-solid fa-star text-warning"></i>
                            <i class="fa-regular fa-star text-warning"></i>
                            4.2/5.0
                        </p>
                        <p class="text-danger fs-32 mt-5">¥23,000</p>
                    </div>
                    <div class="col-3 pb-0 pt-5 mt-5 mb-0">
                        <div class="text-end w-75">
                            <form action="" method="post">
                                @csrf
                                @method('DELETE')

                                <p class="text-start mb-0">Quantity</p>
                                <input type="number" name="quantity" id="quantity" placeholder="Qauntity" class="form-control mb-4 w-100 text-center d-inline" value="1">
                                <input type="submit" value="Delete" class="btn btn-danger w-100 mt-5 mb-0">
                            </form>
                        </div>
                    </div>
                </div>
                <hr>
            @endfor
        </div>
        <div class="text-end my-5 ">
            <form action="{{ route('store.orderConfirm') }}" method="get">
                @csrf
                <button type="submit" class="me-3 p-3 border-0 rounded new-order-confirm-proceed">Proceed to Next</button>
            </form>
        </div>
    </div>
</div>
@endsection
