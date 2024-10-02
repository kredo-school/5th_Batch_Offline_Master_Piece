@extends('layouts.app')

@section('title','register-store')

@section('content')
<div>
    <a href="{{url()->previous()}}" class="fw-bold text-decoration-none main-text btn">
        <div class="h2 fw-semibold">
            <i class="fa-solid fa-caret-left"></i>
            <div class="d-inline main-text">Back</div>
        </div>
    </a>
</div>
<div class="text-center">
    <img src="{{asset("images/logo2.png")}}" alt="" class="login-logo ">
</div>

<div class="container mt-5 mx-auto bg-white w-50 p-5">
    <form action="#" method="post">
    @csrf
    @method('PATCH')

    <div class="row pt-5">
        <div class="col">
            <div class="ps-5">
                <img src="https://th.bing.com/th/id/OIP.Khe4un4CrKghna_BBciHDgHaHa?w=148&h=180&c=7&r=0&o=5&dpr=2&pid=1.7" alt="#" class="img-store-inventory">
            </div><br>

            <label for="avatar" class="form-label">Image File</label>
            <input type="file" name="avatar" id="avatar" class="form-control" >
        </div>
    
        <div class="col">
            <label for="name" class="form-label">Store Name <span class="text-danger">*</span></label>
            <input type="text" name="name" id="name" placeholder="Input Name" class="form-control" required><br>

            <label for="phone" class="form-label">Phone number(without hyphens) <span class="text-danger">*</span></label>
            <input type="number" name="phone" id="phone" placeholder="Phone number" class="form-control" required><br>

            <label for="adress" class="form-label">Adress <span class="text-danger">*</span></label>
            <select name="prefecture" id="prefecture" class="form-select">
                <option value="" hidden>prefecture</option>
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
            </select><br>

            <input type="text" name="address" id="address" placeholder="Address" class="form-control" required>

        </div>
    </div>
    <div class="row w-100 mx-auto mt-5">
        <label for="introduction">Intoroduction</label>
        <textarea name="introduction" id="introduction" cols="30" rows="10" placeholder="Intoroduction"></textarea>
    </div>
    <div class="row w-75 mx-auto mt-5">
        <button type="submit" class="btn btn-warning text-white mb-5">Update</button>
    </div>
</div><br><br><br>
</form>










@endsection