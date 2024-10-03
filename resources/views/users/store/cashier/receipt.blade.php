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
                    Hiroshima 1-20 <br>
                    0120-123-4567
                    {{-- {{ Auth::user()->profile->address }} <br>
                    Tel: {{ Auth::user()->profile->phone_number }} --}}

                    <p class="text-center m-3">RECEIPT</p>
                </div>
                <div>
                    Sep. 12. 2024 Thu. 12:45

                    <table class="w-100">
                        <thead>
                            <th>Description</th>
                            <th class="text-end">Price</th>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Book 1</td>
                                <td class="text-end">¥ 1,182</td>
                            </tr>
                            <tr>
                                <td>Book 2</td>
                                <td class="text-end">¥ 721</td>
                            </tr>
                            <tr>
                                <td>Book 3</td>
                                <td class="text-end">¥ 3,150</td>
                            </tr>
                    </table>
                    <hr>
                    <table class="w-100 mb-5">
                        <tr>
                            <td>Subtotal</td>
                            <td class="text-end">¥ 5,053</td>
                        </tr>
                        <tr>
                            <td>Tax (10%)</td>
                            <td class="text-end">¥ 505</td>
                        </tr>
                        <tr class="fw-bold fs-5">
                            <td>Total</td>
                            <td class="text-end">¥ 5,103</td>
                        </tr>
                        <tr class="fw-bold">
                            <td>Cash</td>
                            <td class="text-end">¥ 5,103</td>
                        </tr>
                        <tr class="fw-bold">
                            <td>Change</td>
                            <td class="text-end">¥ 0</td>
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
