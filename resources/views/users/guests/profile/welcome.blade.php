<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} | @yield('title')</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    {{-- CSS Style --}}
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">



    {{-- fontawesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    {{-- Google font --}}
    <link href="https://fonts.googleapis.com/css2?family=Gothic+A1:wght@400;700&display=swap" rel="stylesheet">

</head>

<body class="main-bg" style="background-color: #FFFCF2">



    @section('title', 'Guest Welcome')

    <main class="py-4">



        <div class="row justify-content-center mt-2">
            <div class="text-center my-4">
                <h1 class="display-3 fw-bold">Welcome {{ Auth::user()->name }}</h1>
                <p class="fs-24 fw-bold">Be patient to fill out the form below</p>
            </div>
            <div class="col-7 row  mt-2 p-5 shadow bg-white rounded">
                <div class="col-md-5">
                    <div class="mx-auto text-center">
                        <i class="fa-solid fa-circle-user icon-lg"></i>
                    </div>
                    <form action="{{ route('profile.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                        <label for="avatar" class="form-label mt-4">Image File</label>
                        <input type="file" name="avatar" id="avatar" placeholder="File"
                            value="{{ old('avatar') }}" class="form-control">
                        <div id="avatar-info" class="form-text">
                            <p class="mb-0">Acceptable formats: jpeg, jpg, png, gif only.</p>
                            <p class="mt-0">Maximum file size is 1048kb.</p>
                        </div>
                        @error('avatar')
                            <p class="text-danger small">{{ $message }}</p>
                        @enderror
                </div>
                <div class="col-md-7">
                    <label for="first_name" class="form-label">First name <span class="text-danger">*</span></label>
                    <input type="text" name="first_name" id="first_name" placeholder="First name"
                        value="{{ old('first_name') }}" class="form-control">
                    @error('first_name')
                        <p class="text-danger small">{{ $message }}</p>
                    @enderror

                    <label for="last_name" class="form-label mt-4">Last name <span class="text-danger">*</span></label>
                    <input type="text" name="last_name" id="last_name" placeholder="Last name"
                        value="{{ old('last_name') }}" class="form-control">
                    @error('last_name')
                        <p class="text-danger small">{{ $message }}</p>
                    @enderror

                    <label for="gender" class="form-label mt-4">gender <span class="text-danger">*</span></label>
                    <select name="gender" id="gender" class="form-select" value="{{ old('gender') }}">
                        <option value="" hidden>Select gender</option>
                        <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>Male</option>
                        <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }}>Female</option>
                    </select>
                    @error('gender')
                        <p class="text-danger small">{{ $message }}</p>
                    @enderror

                    <label for="birthday" class="form-label mt-4">Birthday <span class="text-danger">*</span></label>
                    <input type="date" name="birthday" id="birthday" placeholder="Birthday"
                        value="{{ old('birthday') }}" class="form-control">
                    @error('birthday')
                        <p class="text-danger small">{{ $message }}</p>
                    @enderror

                    <label for="phone_number" class="form-label mt-4">Phone number <span
                            class="text-danger">*</span></label>
                    <input type="tel" name="phone_number" id="phone_number" placeholder="Phone number 10-16 digits"
                        value="{{ old('phone_number') }}" class="form-control">
                    @error('phone_number')
                        <p class="text-danger small">{{ $message }}</p>
                    @enderror

                    <label for="address" class="form-label mt-4">address <span class="text-danger">*</span></label>
                    <select name="address" id="" class="form-select" value="{{ old('address') }}">
                        <option value="" hidden>Address</option>
                        @foreach ($prefectures as $prefecture)
                            <option value="{{ $prefecture }}"
                                {{ optional($user->profile)->address == $prefecture ? 'selected' : '' }}
                                {{ old('address') == $prefecture ? 'selected' : '' }}>
                                {{ $prefecture }}
                            </option>
                        @endforeach
                    </select>
                    @error('address')
                        <p class="text-danger small">{{ $message }}</p>
                    @enderror
                </div>
                <div class="col">

                    <label for="introduction" class="form-label mt-4">Introduction</label>
                    <textarea name="introduction" id="" cols="30" rows="10" class="form-control"
                        placeholder="Introduction">{{ old('introduction') }}</textarea>
                    @error('introduction')
                        <p class="text-danger small">{{ $message }}</p>
                    @enderror
    
                    <button type="submit" class="btn btn-orange mt-4 w-100">Update</button>
                </div>

                </form>
            </div>


        </div>

    </main>

</body>

</html>
