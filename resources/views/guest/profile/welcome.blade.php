@extends('layouts.app')

@section('title', 'Guest Review')


@section('content')


    <div class="row justify-content-center mt-2">
        <div class="text-center my-4">
            <h1 class="display-3 fw-bold">Welcome $username</h1>
            <p class="fs-24 fw-bold">Be patient to fill out the form below</p>
        </div>
        <div class="col-7 row  mt-2 p-5 shadow bg-white rounded">
            <div class="col-5">
                <div class="mx-auto text-center">
                    <i class="fa-solid fa-circle-user icon-lg"></i>
                </div>
                <form action="#" method="post">
                    @csrf
                    @method('PATCH')
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
                <input type="text" name="first_name" id="first_name" placeholder="First name" class="form-control">
                @error('first_name')
                    <p class="text-danger small">{{ $message }}</p>
                @enderror

                <label for="last_name" class="form-label mt-4">Last name <span class="text-danger">*</span></label>
                <input type="text" name="last_name" id="last_name" placeholder="Last name" class="form-control">
                @error('last_name')
                    <p class="text-danger small">{{ $message }}</p>
                @enderror

                <label for="birthday" class="form-label mt-4">Birthday <span class="text-danger">*</span></label>
                <input type="date" name="birthday" id="birthday" placeholder="Birthday" class="form-control">
                @error('birthday')
                    <p class="text-danger small">{{ $message }}</p>
                @enderror

                <label for="phone_number" class="form-label mt-4">Phone number <span class="text-danger">*</span></label>
                <input type="number" name="phone_number" id="phone_number" placeholder="Phone number" class="form-control">
                @error('phone_number')
                    <p class="text-danger small">{{ $message }}</p>
                @enderror

                <label for="address" class="form-label mt-4">address <span class="text-danger">*</span></label>
                <select name="address" id="" class="form-select">
                    <option value="" hidden>Address</option>
                    <option value="hokkaido">Hokkaido</option>
                    <option value="aomori">Aomori</option>
                    <option value="iwate">Iwate</option>
                    <option value="miyagi">Miyagi</option>
                    <option value="akita">Akita</option>
                    <option value="yamagata">Yamagata</option>
                    <option value="fukushima">Fukushima</option>
                    <option value="ibaraki">Ibaraki</option>
                    <option value="tochigi">Tochigi</option>
                    <option value="gunma">Gunma</option>
                    <option value="saitama">Saitama</option>
                    <option value="chiba">Chiba</option>
                    <option value="tokyo">Tokyo</option>
                    <option value="kanagawa">Kanagawa</option>
                    <option value="niigata">Niigata</option>
                    <option value="toyama">Toyama</option>
                    <option value="ishikawa">Ishikawa</option>
                    <option value="fukui">Fukui</option>
                    <option value="yamanashi">Yamanashi</option>
                    <option value="nagano">Nagano</option>
                    <option value="gifu">Gifu</option>
                    <option value="shizuoka">Shizuoka</option>
                    <option value="aichi">Aichi</option>
                    <option value="mie">Mie</option>
                    <option value="shiga">Shiga</option>
                    <option value="kyoto">Kyoto</option>
                    <option value="osaka">Osaka</option>
                    <option value="hyogo">Hyogo</option>
                    <option value="nara">Nara</option>
                    <option value="wakayama">Wakayama</option>
                    <option value="tottori">Tottori</option>
                    <option value="shimane">Shimane</option>
                    <option value="okayama">Okayama</option>
                    <option value="hiroshima">Hiroshima</option>
                    <option value="yamaguchi">Yamaguchi</option>
                    <option value="tokushima">Tokushima</option>
                    <option value="kagawa">Kagawa</option>
                    <option value="ehime">Ehime</option>
                    <option value="kochi">Kochi</option>
                    <option value="fukuoka">Fukuoka</option>
                    <option value="saga">Saga</option>
                    <option value="nagasaki">Nagasaki</option>
                    <option value="kumamoto">Kumamoto</option>
                    <option value="oita">Oita</option>
                    <option value="miyazaki">Miyazaki</option>
                    <option value="kagoshima">Kagoshima</option>
                    <option value="okinawa">Okinawa</option>
                </select>
                @error('address')
                    <p class="text-danger small">{{ $message }}</p>
                @enderror
            </div>
            <label for="introduction" class="form-label mt-4">Introduction</label>
            <textarea name="" id="" cols="30" rows="10" class="form-control" placeholder="Introduction"></textarea>

            <button type="submit" class="btn btn-orange mt-4">Update</button>

            </form>
        </div>


    </div>




@endsection
