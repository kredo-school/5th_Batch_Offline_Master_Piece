@extends('layouts.app')

@section('title','Inquiry')

@section('content')
<form action="{{ route('inquiry.send') }}" method="post">
    @csrf
    <div class="w-75 justify-content-center mx-auto">
        <h2 class="main-text fw-bold">Inquiry</h2>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <label for="email" class="form-label mt-2">Please fill in your email</label>
        <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $user->email) }}" required>
        @error('email')
            <p class="text-danger small">{{ $message }}</p>
        @enderror

        <label for="firstname" class="form-label mt-2">First Name</label>
        <input type="text" name="firstname" id="firstname" class="form-control" value="{{ old('firstname', $user->profile->first_name) }}" required>
        @error('firstname')
            <p class="text-danger small">{{ $message }}</p>
        @enderror

        <label for="lastname" class="form-label mt-2">Last Name</label>
        <input type="text" name="lastname" id="lastname" class="form-control" value="{{ old('lastname', $user->profile->last_name) }}" required>
        @error('lastname')
            <p class="text-danger small">{{ $message }}</p>
        @enderror

        <label for="phone" class="form-label mt-2">Phone Number</label>
        <input type="tel" name="phone" id="phone" class="form-control" value="{{ old('phone', $user->profile->phone_number) }}" required>
        @error('phone')
            <p class="text-danger small">{{ $message }}</p>
        @enderror

        <label class="form-label mt-2">Role</label><br>
        <input type="radio" name="role" id="store" value="store" {{ $user->role_id == 3 ? 'checked' : '' }} required>
        <label for="store" class="form-label">Store</label>
        <input type="radio" name="role" id="guest" value="guest" {{ $user->role_id == 2 ? 'checked' : '' }} required>
        <label for="guest" class="form-label">Guest</label><br>

        <label for="contact" class="form-label mt-2">Inquiry</label>
        <select name="contact" id="contact" class="form-control" required>
            <option value="" hidden>Select the inquiry</option>
            <option value="store">About store</option>
            <option value="reserve">Book Reserve</option>
            <option value="application">Application</option>
        </select>
        @error('contact')
            <p class="text-danger small">{{ $message }}</p>
        @enderror

        <textarea name="details" id="details" cols="30" rows="5" class="form-control mt-2" placeholder="Please fill in the details" required>{{ old('details') }}</textarea>
        @error('details')
            <p class="text-danger small">{{ $message }}</p>
        @enderror

        <div class="d-flex justify-content-end mt-2">
            <input type="submit" value="Send" class="btn btn-orange px-4">
        </div>
    </div>
</form>

@endsection

