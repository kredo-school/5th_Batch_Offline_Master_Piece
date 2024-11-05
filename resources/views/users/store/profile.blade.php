@extends('layouts.app')

@section('title', 'Profile Store')

@section('content')
    {{-- Back button --}}
    <div>
        <a href="{{ url()->previous() }}" class="fw-bold text-decoration-none main-text btn border-0">
            <div class="h2 fw-semibold">
                <i class="fa-solid fa-caret-left"></i>
                <div class="d-inline main-text">Back</div>
            </div>
        </a>
    </div>

    <div class="container-body">
        <div class="row">
            <div class="col">
                <h1 class="h3 main-text fw-bold ms-5">Store Information</h1>
            </div>
            <div class="col text-end">
                <a href="{{ route('store.edit', $store->id) }}" class="btn btn-orange w-25 p-2">Edit Profile</a>
            </div>
        </div>
        <div class="row ms-3 my-5 mb-0 mt-3">
            <div class="col-5">
                <img src="{{ $profile->avatar  }}"
                    alt="Store Image" class="img-store-inventory rounded-3">
            </div>
            <div class="col my-auto ms-5">
                <h2 class="fw-bold mb-3 ">Store Name : {{ $store->name }}</h2> 
                <!-- 電話番号を四桁ごとにハイフンを入れる -->
                <h3 class="mb-3">Phone Number: {{ preg_replace('/(\d{3})(\d{4})(\d{4})/', '$1-$2-$3', $profile->phone_number) }}</h3>
                
                {{-- <h3 class="mt-1">Phone Number : {{ $profile->phone_number}}</h4>  --}}
                <h3 class="mb-3">Store Email : {{ $store->email  }}</h3> 
                <h3 class="mb-3">Store Address : {{ $profile->address  }}</h3> 
            </div>
        </div>
        <h3 class="ms-5 mt-3 main-text fw-bold">Introduction</h3>
        <h4 class="ms-5">
            @if($profile->introduction)
                {{ $profile->introduction }}
            @else
                <span class="text-danger">This store has not provided an introduction yet.</span>
            @endif
        </h4>
        
        {{-- 
            電話番号を四桁ごとにハイフンが入るようにする
            introに情報がないときに典型文が表示されるようにしたい。
        --}}
@endsection
