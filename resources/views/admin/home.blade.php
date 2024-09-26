@extends('layouts.app')

@section('content')

<!-- CSS -->
<link rel="stylesheet" href="{{asset('css/style.css')}}">

<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col">
            <div class="card card-admin mt-3 mx-auto w-75">
                {{-- <div class="card-header text-center"> --}}
                    <h2 class="text-center mt-5 display-2 ">Welcome Admin</h2>
                {{-- </div> --}}

                <div class="card-body mx-auto w-75 mt-3">
                    <div class="row border">
                            <div class="admin-home-btn col-3">
                                <button type="button" class="btn btn-admin">
                                <i class="i-admin fa-solid fa-shop"></i>
                                </button>
                            </div>
                                <div class="col-9">
                                    <row><h2>Store</h2></row>
                                    <row>Lorem ipsum dolor sit amet consectetur adipisicing elit. Repellendus expedita, quisquam eos id quod distinctio sunt reprehenderit, ipsam aliquam ab natus. Rem illo, fuga consectetur consequuntur dolorem veniam eligendi eius.</row>
                                    <row></row>
                                </div>
                    </div>
                </div>
                <div class="card-body mx-auto w-75">
                    <div class="row border">
                            <div class="admin-home-btn col-3">
                                <button type="button" class="btn btn-admin">
                                <i class="i-admin fa-solid fa-book-open"></i>
                                </button>
                            </div>
                                <div class="col-9">
                                    <row><h2>Book</h2></row>
                                    <row>Lorem ipsum dolor sit amet consectetur adipisicing elit. In, voluptate nostrum illo id modi voluptatibus repellendus suscipit eveniet placeat debitis quo labore cupiditate quas recusandae excepturi facere reprehenderit minus sapiente.</row>
                                </div>
                    </div>
                </div>
                <div class="card-body mx-auto w-75">
                    <div class="row border">
                            <div class="admin-home-btn col-3">
                                <button type="button" class="btn btn-admin">
                                <i class="i-admin fa-regular fa-user"></i>
                                </button>
                            </div>
                                <div class="col-9">
                                    <row><h2>Guest</h2></row>
                                    <row>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Unde commodi, quidem, cum accusamus quis facere quisquam veniam asperiores sit aut eum voluptate laudantium cupiditate? Soluta recusandae sapiente harum quidem molestias?</row>
                                </div>
                    </div>
                </div>
                <div class="card-body mx-auto w-75 mb-5">
                    <div class="row border">
                            <div class="admin-home-btn col-3">
                                <button type="button" class="btn btn-admin">
                                <i class="i-admin fa-solid fa-table-cells-large"></i>
                                </button>
                            </div>
                                <div class="col-9">
                                    <row><h2>Genre</h2></row>
                                    <row>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ea velit quos cum eligendi accusamus, voluptates dicta illum necessitatibus nesciunt provident suscipit et exercitationem temporibus, veritatis, a totam. Doloremque, obcaecati vitae.</row>
                                </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- ボタンの飛び先を指定したい
    それぞれの機能に飛ぶようにしたい。
    --}}

@endsection