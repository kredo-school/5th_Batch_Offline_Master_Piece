@extends('layouts.app')

@section('title','new_book')

@section('content')
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link href="https://fonts.googleapis.com/css2?family=Gothic+A1:wght@400;700&display=swap" rel="stylesheet">

    <div class="container-body">
        <form action="#" method="post">
            @csrf
            <div class="d-flex align-items-center">
                <h1 class="h2 fw-bold main-text mt-5 ms-3">New</h1>
                <select name="genre" id="genre" class="form-control w-25 ms-5 mt-5">
                    <option value="" hidden>Genre</option>
                    <option value="comic">Comics</option>
                    <option value="fantasy">Fantasy</option>
                    <option value="horror">Horror</option>
                    <option value="mystery">Mystery</option>
                    <option value="history">History</option>
                    <option value="literature">Literature</option>
                    <option value="kids">Kids</option>
                    <option value="travel">Travel</option>
                    <option value="sports">Sports</option>
                    <option value="study">Study</option>
                    <option value="engineering">Engineering</option>
                    <option value="biology">Biology</option>
                    <option value="romance">Romance</option>
                    <option value="lifestyle">Lifestyle</option>
                    <option value="art">Art</option>
                    <option value="science">Science</option>
                    <option value="physics">Physics</option>
                    <option value="philosophy">Philosophy</option>
                    <option value="qualification">Qualification</option>
                    <option value="magazine">Magazine</option>
                    <option value="music">Music</option>
                    <option value="technology">Technoligy</option>
                    <option value="geology">Geology</option>
                    <option value="psychology">Psychology</option>
                    <option value="others">Others</option>
                </select>
            </div>
            <div class="table-container mt-3">
                @for ($i = 0; $i < 18; $i++)
                    <table class="mt-3">
                        <tbody>
                            <tr>
                                <td>
                                    <img src="https://th.bing.com/th/id/OIP.23rdUcI-az1chMeR7unEFQHaHa?w=150&h=180&c=7&r=0&o=5&dpr=2&pid=1.7" alt="#" class="img-fluid">
                                </td>
                            </tr>
                            <tr>
                                <td><h4>Title</h4></td>
                            </tr>
                            <tr>
                                <td><h5>Author</h5></td>
                            </tr>
                            <tr>
                                <td><h5><i class="fa-solid fa-star"></i> 4</h5></td>
                            </tr>
                            <tr>
                                <td><h4 class="text-danger">¥20,000</h4></td>
                            </tr>
                        </tbody>
                    </table>
                @endfor
            </div>
        </form>
    </div>
@endsection
