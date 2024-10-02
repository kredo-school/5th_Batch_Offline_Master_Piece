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
            <table class="table">
                <thead class="fw-semibold">
                    <th>Reserveation Number</th>
                    <th>Receiving date</th>
                    <th>Reserved date</th>
                </thead>
                <tbody>
                    @for($i = 0; $i < 8; $i++)
                        <tr>
                            <td><a href="#">12345678</a></td>
                            <td>Sep.12.2024</td>
                            <td>Sep.9.2024</td>
                        </tr>
                    @endfor
                </tbody>
            </table>
        </div>

    </div>
@endsection
