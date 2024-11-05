@extends('layouts.app')

@section('content')

<!-- CSS -->
<link rel="stylesheet" href="{{asset('css/style.css')}}">

<div class="container">
    <img src="{{ asset('/images/BB2BB7F8-CA14-4C2A-8606-2DA9E432FEB0.png') }}" alt="" class="register-img mx-auto d-block">
    <div class="row justify-content-center mt-5">
        <div class="col-5">
            <div class="card card-submit mt-3 mx-auto">
                <div class="card-body mx-auto w-100 t-4">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="mb-3 px-3">
                            <label for="email" class="form-label font-solid">{{ __('Email Address') }}</label>
                            <input id="email" type="email" class="form-control form-control-lg @error('email') is-invalid @enderror" placeholder="Email Address" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3 px-3">
                            <label for="password" class="form-label font-solid">{{ __('Password') }}</label>
                            <input id="password" type="password" class="form-control form-control-lg @error('password') is-invalid @enderror" placeholder="Password" name="password" required autocomplete="current-password">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="row mb-3 px-3">
                            <div class="col">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                            <div class="col text-end">
                                <a href="{{ route('register') }}">{{ __('Register') }}</a>
                            </div>
                        </div>

                        <div class="mt-4 mb-4 px-3">
                            <button type="submit" class="btn submit-button w-100">
                                {{ __('Login') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

