@extends('layouts.app')

@section('title', 'Guest Edit')

@section('content')

    <a href="{{ url()->previous() }}" class="fw-bold text-decoration-none main-text btn border-0">
        <div class="h2 fw-semibold">
            <i class="fa-solid fa-caret-left"></i>
            <div class="d-inline main-text">Back</div>
        </div>
    </a>

    <div class="row justify-content-center mt-2">
        <div class="col-7 row  mt-2 p-5 shadow bg-white rounded">
            <div class="col-5">
                <form action="{{ route('profile.update') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="mx-auto text-center">
                        @if (optional($user->profile)->avatar)
                            <img src="{{ optional($user->profile)->avatar }}" alt="{{ $user->name }}"
                                class="rounded-circle shadow p-1 avatar-lg d-block mx-auto ">
                        @else
                            <i class="fa-solid fa-circle-user text-secondary icon-lg"></i>
                        @endif
                    </div>
                    <label for="avatar" class="form-label mt-4">Image File</label>
                    <input type="file" name="avatar" id="avatar" placeholder="File" class="form-control">
                    <div id="avatar-info" class="form-text">
                        <p class="mb-0">Acceptable formats: jpeg, jpg, png, gif only.</p>
                        <p class="mt-0">Maximum file size is 1048kb.</p>
                    </div>
                    @error('avatar')
                        <p class="text-danger small">{{ $message }}</p>
                    @enderror
            </div>
            <div class="col-7 px-4">
                <label for="first_name" class="form-label">First name <span class="text-danger">*</span></label>
                <input type="text" name="first_name" id="first_name" placeholder="First name"
                    value="{{ old('first_name', optional($user->profile)->first_name) }}" class="form-control">
                @error('first_name')
                    <p class="text-danger small">{{ $message }}</p>
                @enderror

                <label for="last_name" class="form-label mt-4">Last name <span class="text-danger">*</span></label>
                <input type="text" name="last_name" id="last_name" placeholder="Last name"
                    value="{{ old('last_name', optional($user->profile)->last_name) }}" class="form-control">
                @error('last_name')
                    <p class="text-danger small">{{ $message }}</p>
                @enderror

                <label for="gender" class="form-label mt-4">gender <span class="text-danger">*</span></label>
                <select name="gender" id="gender" class="form-select">
                    <option value="" hidden>Select gender</option>
                    <option value="Male" {{ optional($user->profile)->gender == 'Male' ? 'selected' : '' }}>Male</option>
                    <option value="Female" {{ optional($user->profile)->gender == 'Female' ? 'selected' : '' }}>Female
                    </option>
                </select>
                @error('gender')
                    <p class="text-danger small">{{ $message }}</p>
                @enderror

                <label for="birthday" class="form-label mt-4">Birthday <span class="text-danger">*</span></label>
                <input type="date" name="birthday" id="birthday" placeholder="Birthday" class="form-control"
                    value="{{ old('birthday', optional($user->profile)->birthday) }}">
                @error('birthday')
                    <p class="text-danger small">{{ $message }}</p>
                @enderror

                <label for="phone_number" class="form-label mt-4">Phone number <span class="text-danger">*</span></label>
                <input type="number" name="phone_number" id="phone_number" placeholder="Phone number"
                    value="{{ old('phone_number', optional($user->profile)->phone_number) }}" class="form-control">
                @error('phone_number')
                    <p class="text-danger small">{{ $message }}</p>
                @enderror

                <label for="address" class="form-label mt-4">address <span class="text-danger">*</span></label>
                <select name="address" id="" class="form-select">
                    <option value="" hidden>Address</option>
                    @foreach ($prefectures as $prefecture)
                        <option value="{{ $prefecture }}"
                            {{ optional($user->profile)->address == $prefecture ? 'selected' : '' }}>{{ $prefecture }}
                        </option>
                    @endforeach
                </select>
                @error('address')
                    <p class="text-danger small">{{ $message }}</p>
                @enderror
            </div>
            <label for="introduction" class="form-label mt-4">Introduction</label>
            <textarea name="introduction" id="" cols="30" rows="10" class="form-control"
                placeholder="Introduction">{{ old('introduction', optional($user->profile)->introduction) }}</textarea>
            @error('introduction')
                <p class="text-danger small">{{ $message }}</p>
            @enderror

            <button type="submit" class="btn btn-orange mt-4">Update</button>


            </form>
        </div>
    </div>
@endsection
