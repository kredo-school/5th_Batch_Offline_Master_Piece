@extends('layouts.app')

@section('title', 'Store Confirm Reservation List')

@section('content')
    <div>
        <a href="{{ route('store.home') }}" class="back-button">
            <i class="fa-solid fa-caret-left"></i> Back
        </a>
    </div>

    <div class="container">
        <div class="w-50 mx-auto">
            <table class="table">
                <thead class="fw-semibold">
                    <th>Reserveation Number</th>
                    <th>Receiving date</th>
                    <th>Reserved date</th>
                </thead>
                <tbody>
                    @for($i = 0; $i < 8; $i++)
                        <tr>
                            <td><a href="{{ route('store.reservationShow') }}">12345678</a></td>
                            <td>Sep.12.2024</td>
                            <td>Sep.9.2024</td>
                        </tr>
                    @endfor
                </tbody>
            </table>
        </div>

    </div>
@endsection
