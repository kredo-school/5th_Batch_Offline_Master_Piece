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
                        <p>Reservation Number:<br><span class="text-dark fw-normal">{{$reservation->reservation_number}}</span></p>
                        <p>Guest name: <span class="text-dark fw-normal">{{$reservation->guest->name}}</span></p>
                        <p>Receiving date: <span class="text-dark fw-normal">{{ date('Y/m/d', strtotime($reservation->receiving_date)) }}</span></p>
                        <p>Reserved date: <span class="text-dark fw-normal">{{ date('Y/m/d', strtotime($reservation->updated_at)) }}</span></p>
                    </div>

                    <table class="table fs-32 table-bordered text-center align-middle">
                        <thead class="main-text fw-semibold">
                            <th>Product</th>
                            <th>Quantity</th>
                            <th>Price</th>
                        </thead>
                        <tbody>
                            @foreach($reserves as $reserve)
                                <tr>
                                    <td>{{$reserve->book->title}}</td>
                                    <td>{{$reserve->quantity}}</td>
                                    <td>¥{{number_format($reserve->book->price)}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card">
                <div class="card-header bg-white">
                    <div class="row align-items-center">
                        <div class="col">
                            <p class="fs-32 mb-0">Total Price:</p>
                        </div>
                        <div class="col-auto text-center">
                            <p class="fs-40 fw-bold mb-0">¥{{number_format($total_price)}}</p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
