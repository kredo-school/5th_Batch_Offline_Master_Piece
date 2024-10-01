@extends('layouts.app')

@section('title', 'Order Confirm')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-8 mx-auto">
                <div class="card">
                    <div class="card-header bg-white">
                        <img src="{{asset('images/BB2BB7F8-CA14-4C2A-8606-2DA9E432FEB0 copy.png')}}" alt="" class="reserved-img mx-auto d-block mb-3">
                        <h1 class="display-2 text-green fw-bold text-center mb-3">Thank you!</h1>

                        <p class="fw-semibold fs-24 mx-5">
                            Your reservation has completed now.
                            Please save this screen and bring it with you.
                            You need the confirmation details below when you receive your order. Thank you so much for using MasterPiece!
                        </p>
                    </div>
                    <div class="card-body bg-white">
                        <div class="mx-3">
                            <div class="main-text fs-32 fw-semibold">Your order number: <span class="text-dark">09120912</span></div>
                            <div class="main-text fs-32 fw-semibold">Received by: <span class="text-dark">Mito store</span></div>
                            <div class="main-text fs-32 fw-semibold">Order total: <span class="text-dark">4 books - ¥13,800</span></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Back button --}}
    <div>
        <a href="#" class="fw-bold text-decoration-none main-text btn">
            <div class="h2 fw-semibold">
                <i class="fa-solid fa-caret-left"></i>
                <div class="d-inline main-text">Go back to homepage</div>
            </div>
        </a>
    </div>
@endsection
