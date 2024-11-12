@extends('layouts.app')

@section('title', 'Store Receipt')

@section('content')

<a href="{{ route('store.cashier') }}" class="fw-bold text-decoration-none main-text btn border-0">
    <div class="h2 fw-semibold">
        <i class="fa-solid fa-caret-left"></i>
        <div class="d-inline main-text">Back</div>
    </div>
</a>

<div class="container">
        <div class="container d-flex justify-content-center mb-5">
            <div class="bg-white shadow" style="display: inline-block; border: solid black; padding: 0 20px;">
                <div class="mt-3 mx-5 text-center sansita-extrabold-italic" style="font-size: 4vw;">{{Auth::user()->name}}</div>
                <div class="mx-5">
                    {{ Auth::user()->profile->address }} <br>
                    Tel: {{ Auth::user()->profile->phone_number }}

                    <p class="text-center m-3">RECEIPT</p>
                </div>
                <div>
                    @if ($latestData)
                        {{ $latestData->created_at }}
                    @endif
                    <table class="w-100">
                        <thead>
                            <th>Description</th>
                            <th class="text-end">Price (JPY)</th>
                        </thead>
                        <tbody>
                            @foreach( $latestData->receiptBook as $receipt_book )
                                <tr>
                                    <td style="display: flex; align-items: center;">{{ $receipt_book->book->title }}</td>
                                    <td class="text-end" style="justify-content: flex-end;">{{ number_format($receipt_book->book->price) }}
                                        <br>{{ $receipt_book->quantity }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                        <hr>
                    <table class="w-100 mb-5">
                        <tr>
                            <td>Subtotal</td>
                            <td class="text-end">{{ number_format($latestData->total_amount/1.1 )}}</td>
                        </tr>
                        <tr>
                            <td>Tax (10%)</td>
                            <td class="text-end">{{ number_format($latestData->total_amount/11 ) }}</td>
                        </tr>
                        <tr class="fw-bold fs-5">
                            <td>Total</td>
                            <td class="text-end">¥ {{ number_format($latestData->total_amount) }}</td>
                        </tr>
                        <tr class="fw-bold">
                            <td>{{ $latestData->payment_method }}</td>
                            <td class="text-end">¥ {{ number_format($latestData->received_amount) }}</td>
                        </tr>
                        <tr class="fw-bold">
                            <td>Change</td>
                            <td class="text-end">¥ {{ number_format($latestData->change_amount) }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>

        <style>
            @import url('https://fonts.googleapis.com/css2?family=Sansita:ital,wght@0,400;0,700;0,800;0,900;1,400;1,700;1,800;1,900&display=swap');
            .sansita-extrabold-italic {
                font-family: "Sansita", sans-serif;
                font-weight: 800;
                font-style: italic;
            }
        </style>

@endsection
