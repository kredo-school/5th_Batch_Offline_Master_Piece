@extends('layouts.app')

@section('title','ranking_book')

@section('content')
    <link href="https://fonts.googleapis.com/css2?family=Gothic+A1:wght@400;700&display=swap" rel="stylesheet">

    <div class="container-body">
        <form action="#" method="post">
            <div class="d-flex align-items-center">
                <h1 class="h2 fw-bold main-text mt-5 ms-3">Ranking</h1>
                <select name="genre" id="genre" class="form-control w-25 ms-5 mt-5">
                    <option value="" hidden>Genre</option>
                    <option value="comic">Comic</option>
                    <option value="fantasy">Fantasy</option>
                    <option value="horror">Horror</option>
                    <option value="mystery">Mystery</option>
                    <option value="history">History</option>
                    <option value="literature">Literature</option>
                    <option value="kids">Kids</option>
                    <option value="travel">Travel</option>
                    <option value="sports">Sports</option>
                    <option value="study">Study</option>
                    <option value="others">Others</option>
                </select>
            </div>
            <div class="table-container mt-3">
                @for ($i = 0; $i < 18; $i++)
                    <table class="mt-3">
                        <tbody>
                            <tr>
                                <td>
                                    <h4>
                                        @if($i + 1 <= 3)
                                            @if($i + 1 === 1)
                                                <i class="fa-solid fa-crown" style="color: gold"></i>  1
                                            @elseif($i + 1 === 2)
                                                <i class="fa-solid fa-crown" style="color: silver"></i>  2
                                            @else
                                                <i class="fa-solid fa-crown" style="color: #9A6229"></i>  3
                                            @endif
                                        @elseif($i + 1 > 3)
                                            {{$i + 1}}
                                        @endif
                                    </h4>
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