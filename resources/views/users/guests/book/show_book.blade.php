@extends('layouts.app')

@section('content')

    <div class="container-body">
        <form action="#" method="post">
            <div class="row">
                <div class="col-4">
                    <img src="https://th.bing.com/th/id/OIP.23rdUcI-az1chMeR7unEFQHaHa?w=150&h=180&c=7&r=0&o=5&dpr=2&pid=1.7" alt="#" class="img-fluid">
                </div>
                <div class="col-8">
                    <h1>Title: <a href=""><i class="fa-solid fa-bookmark"></i></a></h1>
                    <h3>Author: </h3>
                    <h3>Publisher: </h3>
                    <h3>Publish year: </h3>
                    <h3>Description: </h3>
                    <h3>Review: <i class="fa-solid fa-star"></i>4</h3>
                    <h3>Price: </h3>
                    <h3>Genre: </h3>
                    <div class="row">
                        <div class="col gap-5">
                            <select name="area" id="area" class="form-control w-100">
                                <option value="" hidden>area</option>
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
                        </div>
                        <div class="col">
                            <input type="submit" value="Select Store" class="btn btn-select-store w-100">
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="container-body">
        sdfghjkl;
    </div>

@endsection
