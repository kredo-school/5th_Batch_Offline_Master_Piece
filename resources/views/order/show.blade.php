@extends('layouts.app')

@section('title', 'order-show')

@section('content')
    <div class="container">
        <div class="row mt-5">
            <div class="col-9">

                <div class="card ms-5">
                    <div class="card-header bg-white border-bottom-0">
                        <h1 class="section fw-bold mb-3">Confirm Your Order</h1>
                    </div>
                    <div class="card-body card-size overflow-scroll bg-white">
                        <div class="mx-3">

                            {{-- foreach is here --}}
                            <div class="row mb-3 object-fit-cover">
                                <div class="col-3">
                                    {{-- book image--}}
                                    <div class="text-center">
                                        <a href="#"><img src="{{asset('/images/649634 copy.png')}}" alt="" class="border shadow"></a>
                                    </div>
                                </div>
                                <div class="col-6 ps-0">
                                    {{-- book infomation --}}
                                    <a href="#" class="text-decoration-none text-dark"><h2 class="fs-32">Book</h2></a>
                                    <a href="#" class="text-decoration-none text-dark"><h3 class="fs-24">Author</h3></a>
                                    <div class="text-warning fs-5 mt-4">
                                        <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                                        3.2
                                    </div>
                                    <h2 class="text-danger fs-32 m-0">¥2,300</h2>
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

                            <div class="row mb-3 object-fit-cover">
                                <div class="col-3">
                                    {{-- book image--}}
                                    <div class="text-center">
                                        <a href="#"><img src="{{asset('/images/649634 copy.png')}}" alt="" class="border"></a>
                                    </div>
                                </div>
                                <div class="col-6 ps-0">
                                    {{-- book infomation --}}
                                    <a href="#" class="text-decoration-none text-dark"><h2 class="fs-32">Bookosjdhvodnflvisof</h2></a>
                                    <a href="#" class="text-decoration-none text-dark"><h3 class="fs-24">Author</h3></a>
                                    <div class="text-warning fs-5 mt-5">
                                        <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                                        3.2
                                    </div>
                                    <h2 class="text-danger fs-32 m-0">¥2,300</h2>
                                </div>
                                <div class="col-3 text-end">
                                    {{-- store,quantity,delete --}}
                                    <h4>Store: <a href="#" class="text-decoration-none text-dark">Mito store</a></h4>
                                    <h4>Inventory: 4</h4>
                                    <form action="" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <input type="number" name="quantity" id="quantity" placeholder="Qauntity" class="form-control mb-2 mt-5 w-50 text-center d-inline">
                                        <input type="submit" value="Delete" class="btn btn-danger w-50">
                                    </form>
                                </div>
                            </div>
                            <hr>

                            <div class="row mb-3 object-fit-cover">
                                <div class="col-3">
                                    {{-- book image--}}
                                    <div class="text-center">
                                        <a href="#"><img src="{{asset('/images/649634 copy.png')}}" alt="" class="border"></a>
                                    </div>
                                </div>
                                <div class="col-6 ps-0">
                                    {{-- book infomation --}}
                                    <a href="#" class="text-decoration-none text-dark"><h2 class="fs-32">Bookosjdhvodnflvisof</h2></a>
                                    <a href="#" class="text-decoration-none text-dark"><h3 class="fs-24">Author</h3></a>
                                    <div class="text-warning fs-5 mt-5">
                                        <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                                        3.2
                                    </div>
                                    <h2 class="text-danger fs-32 m-0">¥2,300</h2>
                                </div>
                                <div class="col-3 text-end">
                                    {{-- store,quantity,delete --}}
                                    <h4>Store: <a href="#" class="text-decoration-none text-dark">Mito store</a></h4>
                                    <h4>Inventory: 4</h4>
                                    <form action="" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <input type="number" name="quantity" id="quantity" placeholder="Qauntity" class="form-control mb-2 mt-5 w-50 text-center d-inline">
                                        <input type="submit" value="Delete" class="btn btn-danger w-50">
                                    </form>
                                </div>
                            </div>
                            <hr>

                            <div class="row mb-3 object-fit-cover">
                                <div class="col-3">
                                    {{-- book image--}}
                                    <div class="text-center">
                                        <a href="#"><img src="{{asset('/images/649634 copy.png')}}" alt="" class="border"></a>
                                    </div>
                                </div>
                                <div class="col-6 ps-0">
                                    {{-- book infomation --}}
                                    <a href="#" class="text-decoration-none text-dark"><h2 class="fs-32">Bookosjdhvodnflvisof</h2></a>
                                    <a href="#" class="text-decoration-none text-dark"><h3 class="fs-24">Author</h3></a>
                                    <div class="text-warning fs-5 mt-5">
                                        <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                                        3.2
                                    </div>
                                    <h2 class="text-danger fs-32 m-0">¥2,300</h2>
                                </div>
                                <div class="col-3 text-end">
                                    {{-- store,quantity,delete --}}
                                    <h4>Store: <a href="#" class="text-decoration-none text-dark">Mito store</a></h4>
                                    <h4>Inventory: 4</h4>
                                    <form action="" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <input type="number" name="quantity" id="quantity" placeholder="Qauntity" class="form-control mb-2 mt-5 w-50 text-center d-inline">
                                        <input type="submit" value="Delete" class="btn btn-danger w-50">
                                    </form>
                                </div>
                            </div>
                            <hr>

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

                <form action="{{route('order.uploadImage')}}" method="post">
                    @csrf
                    <button type="submit" name="select-store" class="btn btn-warning w-100 p-2">Select Store <i class="fa-solid fa-arrow-right"></i></button>
                </form>
            </div>
        </div>
    </div>


@endsection
