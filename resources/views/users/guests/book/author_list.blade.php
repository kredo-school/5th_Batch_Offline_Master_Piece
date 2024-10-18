@extends('layouts.app')

@section('title', 'search-list')

@section('content')
    {{-- Back button --}}
    <div>
        <a href="{{ url()->previous() }}" class="fw-bold text-decoration-none main-text btn border-0">
            <div class="h2 fw-semibold">
                <i class="fa-solid fa-caret-left"></i>
                <div class="d-inline main-text">Back</div>
            </div>
        </a>
    </div>


    <form action="{{ route('book.searchAuthor') }}" method="get">
        <div class="row justify-content-center mb-5">
            <div class="col-5">
                <form action="#" style="width: 500px" class="d-flex">
                    @csrf
                    <div class="row ms-auto">
                        <div class="col pe-0 position-relative">
                            <input type="text" id="searchInput" name="search" class="form-control rounded searchInput"
                                style="width: 400px" placeholder="Search authors...">
                            <span id="clearButton" class="clearButton">&times;</span>
                        </div>
                        <div class="col ps-1">
                            <button type="submit" class="btn btn-secondary">
                                Search
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </form>
    <div class="row justify-content-center">
        <div class="col-8 mt-1">
            <div class="bg-white rounded my-5 px-5 overflow-auto profile-list">
                <h2 class="h1 fw-bold text-grey mt-3">Search results: {{ $request->has('search') && !empty($request->search) ? $request->search : 'All' }}</h2><br>
                                                                    
                @if ($search_authors->isNotEmpty())
                    @foreach ($search_authors as $author)
                        <div class="row mt-4">
                            <div class="col-3 d-flex justify-content-center">
                                <a href="{{route('book.author_show',$author->id)}}" class="text-decoration-none"><i class="fa-solid fa-circle-user text-secondary icon-md"></i></a>
                            </div>
                            <div class="col fs-32 d-flex align-items-center">
                                <a href="{{route('book.author_show',$author->id)}}" class="text-decoration-none text-grey"><p class="mb-0">{{$author->name}}</p></a>
                            </div>
                        </div>
                        <hr>
                    @endforeach
                @else
                        <h2>Author not found</h2>
                @endif
            </div>
        </div>
    </div>




@endsection
