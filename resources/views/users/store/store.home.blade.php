@extends('layouts.app')

@section('title', 'Store Home')

<div class="container">
    <div class="container">
        <div class="mt-5 d-flex justify-content-center">
            <form action="" method="get" class="d-flex">
                <input type="search" id="store-search" name="search" class="form-control form-control-sm rounded" style="width: 400px" placeholder="Search books...">
                <button type="button" id="clearButton" class="btn btn-sm position-absolute end-0 top-50 translate-middle-y rounded" style="display: none; right: 30px;">
                    ×
                </button>
                <button type="submit" class="btn rounded store-search mx-1">
                    <i class="fa-solid fa-magnifying-glass text-white rounded"></i>
                </button>
            </form>
        </div>

        <div class="row m-5">
            <div class="col-4">
                <a href="" class="store-home-button btn d-flex justify-content-center align-items-center">Cashier</a>
            </div>
            <div class="col-4">
                <a href="" class="store-home-button btn d-flex justify-content-center align-items-center">Reservations</a>
            </div>
            <div class="col-4">
                <a href="" class="store-home-button btn d-flex justify-content-center align-items-center">Book List</a>
            </div>
        </div>
        <div class="row m-5">
            <div class="col-4">
                <a href="" class="store-home-button btn d-flex justify-content-center align-items-center">Analysis</a>
            </div>
            <div class="col-4">
                <a href="" class="store-home-button btn d-flex justify-content-center align-items-center">Inventory</a>
            </div>
        </div>
    </div>

@section('content')

@endsection
