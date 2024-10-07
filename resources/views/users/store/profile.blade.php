@extends('layouts.app')

@section('title', 'Profile Store')

@section('content')
    {{-- Back button --}}
    <div>
        <a href="{{url()->previous()}}" class="fw-bold text-decoration-none main-text btn border-0">
            <div class="h2 fw-semibold">
                <i class="fa-solid fa-caret-left"></i>
                <div class="d-inline main-text">Back</div>
            </div>
        </a>
    </div>

    <div class="container-body">
        <div class="row">
            <div class="col">
                <h1 class="h3 main-text fw-bold">Store Information</h1>
            </div>
            <div class="col text-end">
                <a href="{{ route('store.edit') }}" class="btn btn-orange w-25 p-2">Edit Profile</a>
            </div>
        </div>
        <div class="row ms-3 my-5">
            <div class="col-4">
                <img src="https://th.bing.com/th/id/OIP.Khe4un4CrKghna_BBciHDgHaHa?w=148&h=180&c=7&r=0&o=5&dpr=2&pid=1.7"
                    alt="#" class="img-store-inventory">
            </div>
            <div class=" col my-auto ms-5">
                <h2 class="fw-bold">Store name</h2>
                <h4>0120-123-456</h4>
                <h3> Japan Tokyo 12345</h3>
            </div>
        </div>
        <h4 class="ms-3">Introduction:</h4>
        <h5 class="ms-5">Lorem ipsum dolor sit amet consectetur adipisicing elit. Sapiente nemo pariatur sed libero
            voluptates ipsa est, aliquam nisi dolores, ducimus quis dolor officiis placeat nulla laudantium quas delectus
            debitis quam!</h5>
    </div>
@endsection
