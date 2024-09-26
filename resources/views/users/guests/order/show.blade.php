@extends('layouts.app')

@section('title', 'order-show')

@section('content')
    <div class="container">
        <div class="row mt-5">
            <div class="col-9">

                <div class="card ms-5">
                    <div class="card-header bg-white border-bottom-0">
                        <h1 class="main-text fw-bold mb-3">Order Status</h1>
                    </div>
                    <div class="card-body card-size overflow-auto bg-white">
                        <div class="mx-3">
                            @for ($i = 0; $i < 3; $i++)
                            {{-- foreach is here --}}
                                <div class="row mb-3">
                                    <div class="col-3">
                                        {{-- book image--}}
                                        <div class="text-center">
                                            <a href="#"><img src="{{asset('/images/649634 copy.png')}}" alt="" class="border w-100 shadow"></a>
                                        </div>
                                    </div>
                                    <div class="col-6 fs-32">
                                        {{-- book infomation --}}
                                        <p class="fs-32"><a href="#" class="text-decoration-none text-dark">$book->name</a></p>
                                        <p class="h4"><a href="#" class="text-decoration-none text-dark">$book->author->name</a></p>
                                        <i class="fa-solid fa-star text-warning"></i>
                                        <i class="fa-solid fa-star text-warning"></i>
                                        <i class="fa-solid fa-star text-warning"></i>
                                        <i class="fa-solid fa-star text-warning"></i>
                                        <i class="fa-regular fa-star text-warning"></i>
                                        4.2/5.0
                                        <p class="text-danger fs-32 mt-5">¥23,000</p>
                                    </div>
                                    <div class="col-3 text-end">
                                        {{-- store,quantity,delete --}}
                                        <h4>Store: <a href="#" class="text-decoration-none text-dark">Mito store</a></h4>
                                        <h4>Inventory: 4</h4>
                                        <form action="" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <input type="number" name="quantity" id="quantity" placeholder="Qauntity" class="form-control mb-2 mt-4 w-50 text-center d-inline" value="1">
                                            <input type="submit" value="Delete" class="btn btn-danger w-50">
                                        </form>
                                    </div>
                                </div>
                                <hr>
                            @endfor
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

                <form action="" method="post">
                    @csrf
                    <button type="submit" name="select-store" class="btn btn-warning w-100 p-2">Select Store <i class="fa-solid fa-arrow-right"></i></button>
                </form>
            </div>
        </div>
    </div>


@endsection
