@extends('layouts.app')

@section('title', 'register-store')

@section('content')
<div>
    <a href="{{ url()->previous() }}" class="fw-bold text-decoration-none main-text btn border-0">
        <div class="h2 fw-semibold">
            <i class="fa-solid fa-caret-left"></i>
            <div class="d-inline main-text">Back</div>
        </div>
    </a>
</div>
    
<!-- CSS -->
<link rel="stylesheet" href="{{asset('css/style.css')}}">


<div class="container">
    <img src="{{ asset('/images/BB2BB7F8-CA14-4C2A-8606-2DA9E432FEB0.png') }}" alt="" class="register-img mx-auto d-block">
    <div class="row justify-content-center mt-2">
        <div class="col-5">
            <div class="card card-submit mt-3 mx-auto">
                {{-- <div class="card-header">{{ __('Register') }}</div> --}}

                <div class="card-body mx-auto  w-100 t-4">
                    <form method="POST" action="{{ route('admin.stores.register') }}">
                        @csrf

                        <div class="mb-3 px-3 "> <!-- rowを削除して、ラベルをインプットの上に配置 -->
                            <label for="name" class="form-label font-solid ">{{ __('Username') }}</label>
                            <input id="name" type="text" class="form-control form-control-lg @error('name') is-invalid @enderror" placeholder="Store Name " name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3 px-3">
                            <label for="email" class="form-label">{{ __('Email Address') }}</label>
                            <input id="email" type="email" class="form-control form-control-lg @error('email') is-invalid @enderror" placeholder="Email Address" name="email" value="{{ old('email') }}" required autocomplete="email">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>


                        <div class="mt-4 mb-4 px-3 ">
                            <button type="submit" class=" btn submit-button w-100">
                                {{ __('Register') }}
                            </button>
                        </div>
                        <p class="text-center text-danger">Please fill in the form without mistake.</p>
                        <p class="text-center text-danger">After submitting. Please wait for loading.</p>
                        @if (session('success'))
                        <div class="alert alert-success text-center mx-auto mt-1">
                            {{ session('success') }}
                        </div>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection