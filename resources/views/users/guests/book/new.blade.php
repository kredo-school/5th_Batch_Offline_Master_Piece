@extends('layouts.app')

@section('title','New Book')

@section('content')
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link href="https://fonts.googleapis.com/css2?family=Gothic+A1:wght@400;700&display=swap" rel="stylesheet">

    <div class="container-body">
        <form action="#" method="post">
            @csrf
            <div class="d-flex align-items-center">
                <h1 class="h2 fw-bold main-text mt-5 ms-3">New</h1>
                <select name="genre" id="genre" class="form-select w-25 ms-5 mt-5">
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
                @foreach($newedBooks as $book)
                    <table class="mt-3">
                        <tbody>
                            <tr>
                                <td>
                                    <a href="{{route('book.show_book', $book->id)}}" class="link-book">
                                        <img src="{{$book->image}}" alt="book image {{$book->id}}" class="img-fluid">
                                    </a>                                   
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <h4>
                                        <a href="{{ route('book.show_book', $book->id) }}" class="link-book">{{ $book->title }}</a>
                                    </h4>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <h5>
                                        @foreach ($book->authors as $author)
                                            <a href="{{ route('book.author_show', $author->id) }}" class="link-book">{{ $author->name }}</a>
                                        @endforeach
                                    </h5>
                                </td>
                            </tr>
                            <tr>
                                <td class="star-ration-list d-flex">
                                    <span class="star" data-value="1"><i class="fa-regular fa-star"></i></span>
                                    <span class="star" data-value="2"><i class="fa-regular fa-star"></i></span>
                                    <span class="star" data-value="3"><i class="fa-regular fa-star"></i></span>
                                    <span class="star" data-value="4"><i class="fa-regular fa-star"></i></span>
                                    <span class="star" data-value="5"><i class="fa-regular fa-star"></i></span>
                                    <div class="ms-2">X.X/5.0</div>
                                </td>
                            </tr>
                            <tr>
                                <td><h4 class="text-danger">{{ $book->price }}</h4></td>
                            </tr>
                        </tbody>
                    </table>
                @endforeach
            </div>
            
            
        </form>
    </div>
@endsection
