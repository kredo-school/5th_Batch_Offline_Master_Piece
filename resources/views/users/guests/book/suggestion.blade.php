@extends('layouts.app')

@section('title','Suggestion Book')

@section('content')
    <link href="https://fonts.googleapis.com/css2?family=Gothic+A1:wght@400;700&display=swap" rel="stylesheet">

    <div class="container-body">
        <form action="{{ route('book.suggestion') }}" method="GET">
            <div class="d-flex align-items-center">
                <h1 class="h2 fw-bold main-text mt-5 ms-3">Suggestion</h1>
                
                <div class="dropdown ms-5 mt-5">
                    <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="genreDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        Select genre
                    </button>
                    <ul class="dropdown-menu p-3" aria-labelledby="genreDropdown">
                        <!-- "All genres" チェックボックス -->
                        <li>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="allgenre" onclick="toggleAllGenres(this)">
                                <label class="form-check-label" for="allgenre">All genres</label>
                            </div>
                        </li>
                        <hr> 
                        @foreach($all_genres as $genre)
                            <li>
                                <div class="form-check ms-3">
                                    <input class="form-check-input genre-checkbox" type="checkbox" name="genres[]" value="{{ $genre->id }}" id="genre-{{ $genre->id }}"
                                        {{ is_array($selectedGenreId) && in_array($genre->id, $selectedGenreId) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="genre-{{ $genre->id }}">
                                        {{ $genre->name }}
                                    </label>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
                
                <input type="submit" value="Select" class="btn btn-primary ms-3 mt-5">  
            </div>

            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    const allGenreCheckbox = document.getElementById('allgenre');
                    const genreCheckboxes = document.querySelectorAll('.genre-checkbox');
            
                    allGenreCheckbox.addEventListener('change', function () {
                        genreCheckboxes.forEach(checkbox => {
                            checkbox.checked = allGenreCheckbox.checked;
                        });
                    });
            
                    genreCheckboxes.forEach(checkbox => {
                        checkbox.addEventListener('change', function () {
                            if (!this.checked) {
                                allGenreCheckbox.checked = false; // 一つでも解除されると「All genre」も解除
                            } else if (Array.from(genreCheckboxes).every(cb => cb.checked)) {
                                allGenreCheckbox.checked = true; // 全て選択されたら「All genre」も選択
                            }
                        });
                    });
                });
            </script>
            
            <div class="table-container mt-3">
                @foreach($suggestedBooks as $book)
                    <table class="mt-3">
                        <tbody>
                            <tr>
                                <td>
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
                                <td>
                                    <h4 class="text-danger">{{$book->price}}</h4>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                @endforeach
            </div>
        </form>
    </div>
@endsection
