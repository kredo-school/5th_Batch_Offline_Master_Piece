@extends('layouts.app')

@section('content')

<div class="text-center mt-2">
    <img src="{{asset("images/logo2.png")}}" alt="" class="login-logo ">
</div>

<div class="containe mt-4 w-50 mx-auto">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body mx-auto">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="row mb-3 mt-3">
                            <label for="email" class="form-label ">{{ __('Email Address') }}</label>

                            <div class="col">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3 mt-2">
                            <label for="password" class="form-label">{{ __('Password') }}</label>

                            <div class="col">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row my-5 ">
                            <div class="col">
                                <button type="submit" class="btn btn-warning text-white w-100">
                                    Login
                                </button>
                            </div>

                        <div class="row mb-2 mt-5">
                            <div class="col">
                                <div class="form-check">
                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                </div>
                            </div>
                            <div class="col text-end">
                                <a href="#">Register</a>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
