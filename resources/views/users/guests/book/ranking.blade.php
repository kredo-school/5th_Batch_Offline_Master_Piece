@extends('layouts.app')

@section('title','Ranking Book')

@section('content')
    <link href="https://fonts.googleapis.com/css2?family=Gothic+A1:wght@400;700&display=swap" rel="stylesheet">

    <div class="container-body">
        <form action="{{ route('book.ranking') }}" method="GET">
            <div class="d-flex align-items-center">
                <h1 class="h2 fw-bold main-text mt-5 ms-3">Ranking</h1>
                <select name="genre" id="genre" class="form-select w-25 ms-5 mt-5" onchange="this.form.submit()">
                    <option value="">All genres</option>
                    @foreach($all_genres as $genre)
                        <option value="{{ $genre->id }}" 
                            {{ $selectedGenreId == $genre->id ? 'selected' : '' }}>
                            {{ $genre->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="table-container mt-3">
                @foreach($rankedBooks as $index => $book)
                    <table class="mt-3">
                        <tbody>
                            <tr>
                                <td>
                                    <h4>
                                        @if($index + 1 <= 3)
                                            @if($index + 1 === 1)
                                                <i class="fa-solid fa-crown" style="color: gold"></i>  1
                                            @elseif($index + 1 === 2)
                                                <i class="fa-solid fa-crown" style="color: silver"></i>  2
                                            @else
                                                <i class="fa-solid fa-crown" style="color: #9A6229"></i>  3
                                            @endif
                                        @elseif($index + 1 > 3)
                                            {{$index + 1}}
                                        @endif
                                    </h4>
                                    <a href="{{route('book.show_book', $book->id)}}" class="link-book">
                                        <img src="{{$book->image}}" alt="book image {{$book->id}}" class="img-fluid mb-3">
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <h4>
                                        <a href="{{route('book.show_book', $book->id)}}" class="link-book">{{$book->title}}</a>
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
                                    @php
                                        $averageStarCount = $book->reviews->avg('star_count');
                                        $fullStars = floor($averageStarCount); // 満点の数
                                        $halfStar = $averageStarCount - $fullStars >= 0.1; // 半点があるか
                                        $emptyStars = 5 - $fullStars - ($halfStar ? 1 : 0); // 残りの星
                                    @endphp
                                        {{-- 満点の星を表示 --}}
                                        @for ($i = 0; $i < $fullStars; $i++)
                                        <i class="fa-solid fa-star text-warning"></i>
                                        @endfor
                                        
                                    {{-- 半点の星を表示 --}}
                                    @if ($halfStar)
                                        <i class="fa-solid fa-star-half-stroke text-warning"></i>
                                        @endif
                                        
                                        {{-- 未満の星を表示 --}}
                                        @for ($i = 0; $i < $emptyStars; $i++)
                                        <i class="fa-regular fa-star text-warning"></i>
                                    @endfor

                                    {{ number_format($averageStarCount, 1) }}/5.0
                                </td>
                            </tr>
                            <tr>
                                <td><h4 class="text-danger">{{$book->price}}</h4></td>
                            </tr>
                        </tbody>
                    </table>
                @endforeach
            </div>
        </form>
    </div>
@endsection
