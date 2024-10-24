@extends('layouts.app')

@section('title', 'Order Confirm')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-8 mx-auto">
                <div class="card">
                    <div class="card-header bg-white">
                        <img src="{{asset('images/BB2BB7F8-CA14-4C2A-8606-2DA9E432FEB0 copy.png')}}" alt="masterpiece-icon" class="reserved-img mx-auto d-block mb-3">
                        <h1 class="display-2 text-green fw-bold text-center mb-3">Thank you!</h1>

                        <p class="fw-semibold fs-24 mx-5">
                            Your reservation has completed now.
                            Please save this screen and bring it with you.
                            You need the confirmation details below when you receive your order. Thank you so much for using MasterPiece!
                        </p>
                    </div>
                    <div class="card-body bg-white">
                        <div class="mx-3 main-text fs-24 fw-semibold">
                            <div class="row mb-3">
                                <div class="col-auto">
                                    <div class="">Your order number:</div>
                                </div>
                                <div class="col text-dark ms-1">
                                    @foreach ($stores as $store)
                                        {{$store->name}}:
                                        {{$reservationNumber[$store->id]}}

                                        @if (!$loop->last)
                                            <br>
                                        @endif
                                    @endforeach
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-auto">
                                    <p>Received by:</p>
                                </div>
                                <div class="col">

                                    @foreach ($stores as $store)
                                        <span class="text-dark">{{$store->name}}
                                            @php
                                                $receiving = $today
                                            @endphp
                                            @foreach ($reserves as $reserve)
                                                @if ($reserve->quantity > $reserve->inventory->stock)
                                                    @php
                                                        $receiving = $threeDaysLater
                                                    @endphp
                                                @endif
                                            @endforeach

                                            ({{$receiving}})
                                        </span>

                                        @if (!$loop->last)
                                            <br>
                                        @endif
                                    @endforeach
                                </div>
                            </div>

                            <p>Order total:
                                <span class="text-dark">
                                    {{$total_quantity}} books - ¥{{number_format($total_price)}}
                                </span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Back button --}}
    <div>
        <a href="{{route('home')}}" class="fw-bold text-decoration-none main-text btn">
            <div class="h2 fw-semibold">
                <i class="fa-solid fa-caret-left"></i>
                <div class="d-inline main-text">Go back to homepage</div>
            </div>
        </a>
    </div>
@endsection
