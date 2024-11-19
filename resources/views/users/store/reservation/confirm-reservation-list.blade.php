@extends('layouts.app')

@section('title', 'Store Confirm Reservation List')

@section('content')
<a href="{{ route('store.home') }}" class="fw-bold text-decoration-none main-text btn border-0">
    <div class="h2 fw-semibold">
        <i class="fa-solid fa-caret-left"></i>
        <div class="d-inline main-text">Back</div>
    </div>
</a>

<div class="container">
        <div class="w-50 mx-auto">
            <table class="table">
                <thead class="fw-semibold">
                    <th>Reserveation Number</th>
                    <th>Receiving date</th>
                    <th>Reserved date</th>
                </thead>
                <tbody>
                    @foreach ($storeReserved as $reserve)
                        @if (!in_array($reserve->reservation_number, $reservationNumber))
                            @if ($reserve->deleted_at)
                                <tr class="table-secondary">
                                    <td><a href="{{ route('store.reservationShow', $reserve->id) }}"><i class="fa-solid fa-check"></i> {{$reserve->reservation_number}}</a></td>
                                    <td>
                                        {{ date('Y/m/d', strtotime($reserve->receiving_date)) }}
                                    </td>
                                    <td>
                                        {{ date('Y/m/d', strtotime($reserve->updated_at)) }}
                                    </td>
                                </tr>
                            @else
                                <tr>
                                    <td><a href="{{ route('store.reservationShow', $reserve->id) }}">{{$reserve->reservation_number}}</a></td>
                                    <td>
                                        {{ date('Y/m/d', strtotime($reserve->receiving_date)) }}
                                    </td>
                                    <td>
                                        {{ date('Y/m/d', strtotime($reserve->updated_at)) }}
                                    </td>
                                </tr>
                            @endif
                        @endif

                        @php
                            $reservationNumber[] = $reserve->reservation_number;
                            $receivnig_date[] = $reserve->receivnig_date;
                        @endphp

                    @endforeach
                </tbody>
            </table>

            <div class="justify-content-center d-flex">
                {{ $storeReserved->links() }}
            </div>

        </div>
    </div>
@endsection
