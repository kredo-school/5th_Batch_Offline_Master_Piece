@extends('layouts.app')

@section('title', 'Store Confirm Reservation List')

@section('content')
    <div>
        <a href="{{url()->previous()}}" class="fw-bold text-decoration-none main-text btn border-0">
            <div class="h2 fw-semibold">
                <i class="fa-solid fa-caret-left"></i>
                <div class="d-inline main-text">Back</div>
            </div>
        </a>
    </div>

    <div class="container">
        <div class="w-50 mx-auto">
            <div class="card mb-3">
                <div class="card-header bg-white">
                    <h1 class="fw-bold mb-0">Order Details</h1>
                </div>
                <div class="card-body bg-white">
                    <div class="fw-semibold main-text fs-32">
                        <p>Guest name: <span class="text-dark fw-normal">ponpoko</span></p>
                        <p>Receiving date: <span class="text-dark fw-normal">Sep.12.2024</span></p>
                        <p>Reserved date: <span class="text-dark fw-normal">Sep.9.2024</span></p>
                    </div>

                    <table class="table fs-32 table-bordered">
                        <thead class="main-text fw-semibold">
                            <th>Product</th>
                            <th>Quantity</th>
                            <th>Price</th>
                        </thead>
                        <tbody class="text-center">
                            @for($i = 0; $i < 5; $i++)
                                <tr>
                                    <td>Dog</td>
                                    <td>1</td>
                                    <td>¥800</td>
                                </tr>
                            @endfor
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card">
                <div class="card-header bg-white">
                    <div class="row">
                        <div class="col">
                            <p class="fs-32">Total Price:</p>
                        </div>
                        <div class="col-auto text-center">
                            <p class="fs-40 fw-bold">¥1,5000</p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
