@extends('layouts.app')

@section('content')

<!-- CSS -->
<link rel="stylesheet" href="{{asset('css/style.css')}}">


<div class="container">
    <img src="{{ asset('/images/BB2BB7F8-CA14-4C2A-8606-2DA9E432FEB0.png') }}" alt="" class="register-img mx-auto d-block">
    <div class="row justify-content-center mt-5">
        <div class="col-5"> 
            <div class="card mt-3 mx-auto">
                {{-- <div class="card-header">{{ __('Register') }}</div> --}}

                <div class="card-body mx-auto  w-100 t-4">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="mb-3 px-3 "> <!-- rowを削除して、ラベルをインプットの上に配置 -->
                            <label for="name" class="form-label font-solid ">{{ __('Username') }}</label>
                            <input id="name" type="text" class="form-control form-control-lg @error('name') is-invalid @enderror" placeholder="Username " name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
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

                        <div class="mb-3 px-3">
                            <label for="password" class="form-label">{{ __('Password') }}</label>
                            <input id="password" type="password" class="form-control form-control-lg @error('password') is-invalid @enderror" placeholder="Password" name="password" required autocomplete="new-password">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3 px-3">
                            <label for="password-confirm" class="form-label">{{ __('Password Confirm') }}</label>
                            <input id="password-confirm" type="password" class="form-control form-control-lg" placeholder="Password Confirm" name="password_confirmation" required autocomplete="new-password">
                        </div>

                        <div class="mt-4 mb-4 px-3 ">
                            <button type="submit" class=" btn submit-button w-100">
                                <a href="#" class="a1 text-decoration-none">
                                {{ __('Register') }}
                                </a>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
