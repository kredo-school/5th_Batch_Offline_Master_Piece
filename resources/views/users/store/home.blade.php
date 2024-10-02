@extends('layouts.app')

@section('title', 'Store Home')

@section('content')

    <div class="container">
        <div class="mt-5 d-flex justify-content-center">
            <form action="{{ route('store.search') }}" method="get" class="d-flex">
                <input type="text" id="store-search" name="store_search" class="form-control form-control-sm rounded" style="width: 400px" placeholder="Search books...">
                <button type="button" id="clearButton" class="btn btn-sm position-absolute end-0 top-50 translate-middle-y rounded" style="display: none; right: 30px;">
                    ×
                </button>
                <button type="submit" class="btn rounded store-search mx-1">
                    <i class="fa-solid fa-magnifying-glass text-white rounded"></i>
                </button>
            </form>
        </div>

        <div style="margin-inline-start: 5%;">
            <div class="row m-5">
                <div class="col-4">
                    <a href="{{ route('store.cashier') }}" class="store-home-button">Cashier</a>
                </div>
                <div class="col-4">
                    <a href="{{ route('store.reservationList') }}" class="store-home-button">Reservations</a>
                </div>
                <div class="col-4">
                    <a href="{{ route('store.bookList') }}" class="store-home-button">Book List</a>
                </div>
            </div>
            <div class="row m-5">
                <div class="col-4">
                    <a href="{{ route('store.analysis') }}" class="store-home-button">Analysis</a>
                </div>
                <div class="col-4">
                    <a href="{{ route('store.inventory') }}" class="store-home-button">Inventory</a>
                </div>
                <div class="col-4">
                    <a href="{{ route('store.newOrderConfirm') }}" class="store-home-button">Order</a>
                </div>
            </div>
        </div>
    </div>

@endsection
