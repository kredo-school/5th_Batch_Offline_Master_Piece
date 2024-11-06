
{{-- resources/views/users/store/edit-store.blade.php --}}
@extends('layouts.app')

@section('title', 'Edit Store')

@section('content')
<div>
    <a href="{{ url()->previous() }}" class="fw-bold text-decoration-none main-text btn border-0">
        <div class="h2 fw-semibold">
            <i class="fa-solid fa-caret-left"></i>
            <div class="d-inline main-text">Back</div>
        </div>
    </a>
</div>
<div class="text-center">
    <img src="{{ asset('images/logo2.png') }}" alt="" class="login-logo">
</div>

{{-- 以下、フォーム --}}

{{-- フォーム開始 --}}
<div class="container mt-5 mx-auto bg-white w-50 p-5">
    <form action="{{ route('store.update', ['id' => $store->id]) }}" method="post" enctype="multipart/form-data">
    @csrf
        @method('PATCH')

        <div class="row pt-5">
            <div class="col">
                @if (optional($store->profile)->avatar)
                    <img src="{{ optional($store->profile)->avatar }}" alt="{{ $store->name }}"
                        class="img-store-inventory mt-3">
                @else
                    <img src="{{ $store->avatar ? asset('storage/' . $store->avatar) : 'https://via.placeholder.com/150' }}" alt="Store Avatar" class="img-store-inventory mt-3">
                @endif
                <div class="mt-4">
                    <label for="avatar" class="form-label"><span class="text-danger">Maximum file size is 1048kb.</span></label>
                    <input type="file" name="avatar" id="avatar" class="form-control mt-2">
                </div>
            </div>

            <div class="col">
                <label for="name" class="form-label">Store Name</label>
                <input type="text" name="name" id="name" placeholder="Input Name" value="{{ old('name', $store->name) }}" class="form-control" required><br>

                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" id="email" placeholder="Input Email" value="{{ old('email', $store->email) }}" class="form-control" required><br>

                <label for="phone" class="form-label"><span class="text-danger fs-5">*</span> Phone number (no hyphens)</label>
                <input type="text" name="phone" id="phone" placeholder="Phone number" value="{{ old('phone', optional($store->profile)->phone_number) }}" class="form-control" required><br>

                <p class="mb-1"><span class="text-danger fs-5">*</span> Store location</p>
                <select name="prefecture" id="prefecture" class="form-select w-50" required>
                    <option value="" hidden>Prefecture</option>
                    @foreach ($prefectures as $prefecture)
                        <option value="{{ $prefecture }}" {{ old('prefecture', explode(', ', optional($store->profile)->address)[0]) == $prefecture ? 'selected' : '' }}>
                            {{ $prefecture }}
                        </option>
                    @endforeach
                </select>

                <input type="text" name="address" id="address" placeholder="Municipalities" value="{{ old('address', implode(' ', array_slice(explode(', ', optional($store->profile)->address), 1))) }}" class="form-control" required>
                <label for="address" class="form-label text-danger">Write municipalities without the prefecture.</label>
            </div>
        </div>

        <div class="row w-100 mx-auto mt-5">
            <label for="introduction" class="form-label"><span class="text-danger fs-5">*</span> Introduction</label>
            <textarea name="introduction" id="introduction" cols="30" rows="5" placeholder="Store introduction" class="form-control">{{ old('introduction', optional($store->profile)->introduction) }}</textarea>
        </div>

        <div class="row w-75 mx-auto mt-5">
            <button type="submit" class="btn btn-warning text-white mb-5">Update</button>
        </div>

        @if (session('success'))
            <div class="alert alert-success text-center mx-auto mt-1">
                {{ session('success') }}
            </div>
        @endif
    </form>
</div>
@endsection
