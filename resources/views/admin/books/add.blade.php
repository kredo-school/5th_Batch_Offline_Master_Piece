@extends('layouts.app')

@section('title', 'Store Confirm Reservation List')

@section('content')
    <div>
        <a href="{{ url()->previous() }}" class="fw-bold text-decoration-none main-text btn border-0">
            <div class="h2 fw-semibold">
                <i class="fa-solid fa-caret-left"></i>
                <div class="d-inline main-text">Back</div>
            </div>
        </a>
    </div>

    <div class="container">
        <div class="card mb-5">
            <form action="{{ route('admin.books.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card-header bg-white">
                    <div class="row mt-3 mb-3">
                        <div class="col text-center">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @elseif (session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @elseif (session('error'))
                                <div class="alert alert-danger">
                                    {{ session('error') }}
                                </div>
                            @endif
                            <label for="book-cover" class="form-label fw-semibold">Book Cover</label><br>
                            <i class="fa-solid fa-book book-lg"></i>
                            <input type="file" name="image" id="book-cover" class="form-control w-50 mx-auto mt-4" value="{{old('image')}}">
                            @error('image')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col">
                            <div class="row mb-3">
                                <div class="col-3">
                                    <label for="title" class="text-capitalize fw-semibold">Title:</label>
                                </div>
                                <div class="col-9">
                                    <input type="text" name="title" id="title" class="form-control" value="{{old('title')}}">
                                    @error('title')
                                        <div class="text-danger small">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-3">
                                    <label for="author" class="text-capitalize fw-semibold">author:</label>
                                </div>
                                <div class="col-9">
                                    <input list="authortags" name="name" id="author" class="form-control"
                                        autocomplete="off" value="{{old('name')}}">
                                    @error('name')
                                        <div class="text-danger small">{{ $message }}</div>
                                    @enderror
                                    <datalist id="authortags">
                                        @foreach ($all_authors as $author)
                                            <option value="{{ $author->name }}"></option>
                                        @endforeach
                                    </datalist>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-3">
                                    <label for="publisher" class="text-capitalize fw-semibold">publisher:</label>
                                </div>
                                <div class="col-9">
                                    <input type="text" name="publisher" id="publisher" class="form-control" value="{{old('publisher')}}">
                                    @error('publisher')
                                        <div class="text-danger small">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-3">
                                    <label for="publish-date" class="text-capitalize fw-semibold">Publish date:</label>
                                </div>
                                <div class="col-9">
                                    <input type="date" name="publication_date" id="publish-date" class="form-control" value="{{old('publication_date')}}">
                                    @error('publication_date')
                                        <div class="text-danger small">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-3">
                                    <label for="isbn_code" class="text-capitalize fw-semibold">Isbn_code:</label>
                                </div>
                                <div class="col-9">
                                    <input type="number" name="isbn_code" id="isbn_code" class="form-control" value="{{old('isbn_code')}}">
                                    @error('isbn_code')
                                        <div class="text-danger small">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-3">
                                    <label for="price" class="text-capitalize fw-semibold">Price:</label>
                                </div>
                                <div class="col-9">
                                    <input type="number" name="price" id="price" class="form-control" value="{{old('price')}}">
                                    @error('price')
                                        <div class="text-danger small">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-3">
                                    <label for="description" class="text-capitalize fw-semibold">description:</label>
                                </div>
                                <div class="col-9">
                                    <textarea name="description" id="description" rows="6" class="form-control">{{old('desctiption')}}</textarea>
                                    @error('description')
                                        <div class="text-danger small">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>



                        </div>

                    </div>
                    <div class="mb-5 row justify-content-center ">
                        <div class="col-10">
                            <label for="" class="text-capitalize fw-semibold">genre:</label><br>
                            @foreach ($all_genres as $genre)
                                <div class="form-check form-check-inline mt-3">
                                    <input type="checkbox" name="genres[]" id="{{ $genre->name }}"
                                        value="{{ $genre->id }}" class="form-check-input">
                                    <label for="{{ $genre->name }}"
                                        class="form-check-label main-text fw-semibold">{{ $genre->name }}</label>
                                </div>
                            @endforeach
                            @error('genres')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>


                    </div>

                    <button type="submit" name="btn_add" class="btn btn-orange w-25 d-block mx-auto mb-3">
                        <i class="fa-solid fa-plus"></i> Add
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
