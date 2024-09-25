@extends('layouts.app')

@section('title', 'order-confirm')

@section('content')
    <div class="ms-3">
        <a href="#" class="fw-bold h1 text-decoration-none main-text">
            <i class="fa-solid fa-caret-left"></i>
            <div class="d-inline main-text">Back</div>
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
                <div class="card mb-5">
                    <div class="card-header bg-white border-bottom-0 d-inline">
                        <div class="row h2 mb-3">
                            <div class="col">
                                <i class="fa-solid fa-store"></i>
                                <div class="ms-auto d-inline">
                                    Store: <a href="#" class="text-decoration-none main-text">Mito store</a>
                                </div>
                            </div>
                            <div class="col text-end">Receiving Date: <span class="main-text">Right Now</span></div>
                        </div>
                    </div>


                    <div class="card-body bg-white">
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
                            <div class="col-3 d-flex align-items-end ps-0">
                                {{-- store,quantity,delete --}}
                                <div class="d-block w-100 me-3">
                                    <div class="row h3 mb-3">
                                        <div class="col">Stock:</div>
                                        <div class="col main-text text-end">4</div>
                                    </div>
                                    <div class="row h3">
                                        <div class="col">Quantity:</div>
                                        <div class="col main-text text-end">1</div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <hr>


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
                            <div class="col-3 d-flex align-items-end ps-0">
                                {{-- store,quantity,delete --}}
                                <div class="d-block w-100 me-3">
                                    <div class="row h3 mb-3">
                                        <div class="col">Stock:</div>
                                        <div class="col main-text text-end">4</div>
                                    </div>
                                    <div class="row h3">
                                        <div class="col">Quantity:</div>
                                        <div class="col main-text text-end">1</div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <hr>

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
                            <div class="col-3 d-flex align-items-end ps-0">
                                {{-- store,quantity,delete --}}
                                <div class="d-block w-100 me-3">
                                    <div class="row h3 mb-3">
                                        <div class="col">Stock:</div>
                                        <div class="col main-text text-end">4</div>
                                    </div>
                                    <div class="row h3">
                                        <div class="col">Quantity:</div>
                                        <div class="col main-text text-end">1</div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <hr>

                    </div>
                </div>


                {{-- Selected Store --}}
                <div class="card mb-5">
                    <div class="card-header bg-white border-bottom-0 d-inline">
                        <div class="row h2 mb-3">
                            <div class="col">
                                <i class="fa-solid fa-store"></i>
                                <div class="ms-auto d-inline">
                                    Store: <a href="#" class="text-decoration-none main-text">Mito store</a>
                                </div>
                            </div>
                            <div class="col text-end">Receiving Date: <span class="main-text">Right Now</span></div>
                        </div>
                    </div>


                    <div class="card-body bg-white">
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
                            <div class="col-3 d-flex align-items-end ps-0">
                                {{-- store,quantity,delete --}}
                                <div class="d-block w-100 me-3">
                                    <div class="row h3 mb-3">
                                        <div class="col">Stock:</div>
                                        <div class="col main-text text-end">4</div>
                                    </div>
                                    <div class="row h3">
                                        <div class="col">Quantity:</div>
                                        <div class="col main-text text-end">1</div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <hr>


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
                            <div class="col-3 d-flex align-items-end ps-0">
                                {{-- store,quantity,delete --}}
                                <div class="d-block w-100 me-3">
                                    <div class="row h3 mb-3">
                                        <div class="col">Stock:</div>
                                        <div class="col main-text text-end">4</div>
                                    </div>
                                    <div class="row h3">
                                        <div class="col">Quantity:</div>
                                        <div class="col main-text text-end">1</div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <hr>

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
                            <div class="col-3 d-flex align-items-end ps-0">
                                {{-- store,quantity,delete --}}
                                <div class="d-block w-100 me-3">
                                    <div class="row h3 mb-3">
                                        <div class="col">Stock:</div>
                                        <div class="col main-text text-end">4</div>
                                    </div>
                                    <div class="row h3">
                                        <div class="col">Quantity:</div>
                                        <div class="col main-text text-end">1</div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <hr>

                    </div>
                </div>

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
                                <th class="bg-white">Quantity</th>
                                <th class="bg-white">Subtotal Price</th>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="bg-white"><span class="main-text">Mito store</span></td>
                                    <td class="bg-white"><span class="main-text">3</span></td>
                                    <td class="bg-white"><span class="main-text">¥6,900</span></td>
                                </tr>
                                <tr>
                                    <td class="bg-white"><span class="main-text">Mito store</span></td>
                                    <td class="bg-white"><span class="main-text">3</span></td>
                                    <td class="bg-white"><span class="main-text">¥6,900</span></td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="text-end me-5 display-5 fw-bold">
                            Total: ¥13,800
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col text-end">
                        <a href="#" class="btn btn-outline-secondary w-50 p-3">
                            <div class="h3 m-0"><i class="fa-solid fa-arrow-left"></i> Back</div>
                        </a>
                    </div>
                    <div class="col">
                        <form action="" method="post">
                            @csrf
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
