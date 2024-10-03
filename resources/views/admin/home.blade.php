@extends('layouts.app')

@section('content')

<!-- CSS -->
<link rel="stylesheet" href="{{asset('css/style.css')}}">

<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col">
            <div class="card card-admin mt-3 mx-auto w-75">
                {{-- <div class="card-header text-center"> --}}
                    <h2 class="text-center mt-5 display-2 ">Welcome $User</h2>
                {{-- </div> --}}

                <div class="card-body mx-auto w-75 mt-3">
                    <div class="row border"  style="border-radius: 15px;">
                            <button type="button" class="admin-home-btn col-3 btn ">
                                <i class="i-admin fa-solid fa-shop"></i>
                            </button>
                                <div class="col-9">
                                    <row><h2>Store</h2></row>
                                    <row class="fw-bold">
                                        <p>You can check registerd store and status.</p>
                                        <p>You can add the store on this page.</p>
                                        <p>You can move to the store page, push the store icon.</p>
                                    </row>
                                </div>
                    </div>
                </div>

                <div class="card-body mx-auto w-75">
                    <div class="row border" style="border-radius: 15px;">
                            <div class="admin-home-btn col-3">
                                <button type="button" class="btn btn-admin">
                                <i class="i-admin fa-solid fa-book-open"></i>
                                </button>
                            </div>
                                <div class="col-9">
                                    <row><h2>Book</h2></row>
                                    <row class="fw-bold">
                                        <p>You can check registerd book and status.</p>
                                        <p>You can add the book on this page.</p>
                                        <p>You can move to the book page, push the book icon.</p>
                                    </row>
                                </div>
                    </div>
                </div>
                <div class="card-body mx-auto w-75">
                    <div class="row border" style="border-radius: 15px;">
                            <div class="admin-home-btn col-3">
                                <button type="button" class="btn btn-admin">
                                <i class="i-admin fa-regular fa-user"></i>
                                </button>
                            </div>
                                <div class="col-9">
                                    <row><h2>Guest</h2></row>
                                    <row class="fw-bold">
                                        <p>You can check registerd guest and status.</p>
                                        <p>You can delete the guest on this page.</p>
                                        <p>You can move to guest page, push the guest icon.</p>
                                    </row>
                                </div>
                    </div>
                </div>
                <div class="card-body mx-auto w-75 mb-5">
                    <div class="row border" style="border-radius: 15px;">
                            <div class="admin-home-btn col-3">
                                <button type="button" class="btn btn-admin">
                                <i class="i-admin fa-solid fa-table-cells-large"></i>
                                </button>
                            </div>
                                <div class="col-9">
                                    <row><h2>Genre</h2></row>
                                    <row class="fw-bold">
                                        <p>You can check registerd genre and status.</p>
                                        <p>You can add the genre on this page.</p>
                                        <p>You can move to genre page, push the genre icon.</p>
                                    </row>
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