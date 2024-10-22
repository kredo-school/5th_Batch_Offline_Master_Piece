@extends('layouts.app')

@section('title', 'Thread Create')

@section('content')
    <div class="container-fluid">
        <div class="row">
            {{-- advertisement --}}
            <div class="col-2">
                @for($i = 0; $i < 2; $i++)
                    <img src="{{asset('images/93e1a9cf543ecd9d8bdaf98c51dc65a5.jpg')}}" alt="" class="w-100 mb-3">
                @endfor
            </div>
            <div class="col-8">
                <form action="{{route('thread.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <label for="title" class="form-label fw-semibold">Title <span class="text-danger">*</span></label>
                    <input type="text" name="title" id="title" class="form-control mb-3" placeholder="Title" value="{{old('title')}}">
                    @error('title')
                            <p class="text-danger small">{{$message}}</p>
                    @enderror

                    <label for="genre" class="form-label fw-semibold">Select Genre</label>
                    <div class="mb-3">
                        @foreach ($all_genres as $genre)
                            <div class="form-check form-check-inline">
                                <input type="checkbox" name="genre[]" id="{{$genre->name}}" value="{{$genre->id}}" class="form-check-input">
                                <label for="{{$genre->name}}" class="form-check-label main-text fw-semibold">{{$genre->name}}</label>
                            </div>
                        @endforeach
                        @error('genre')
                            <p class="text-danger small">{{$message}}</p>
                        @enderror
                    </div>

                    <label for="genre" class="form-label fw-semibold">First comment <span class="text-danger">*</span></label>
                    <textarea name="body" id="comment" cols="" rows="8" placeholder="Add comment" class="form-control mb-3">{{old('body')}}</textarea>
                    @error('body')
                        <p class="text-danger small">{{$message}}</p>
                    @enderror

                    <label for="genre" class="form-label fw-semibold">Image file</label>
                    <input type="file" name="image" id="image" class="form-control w-25 mb-5">
                    @error('image')
                        <p class="text-danger small">{{$message}}</p>
                    @enderror

                    <input type="submit" value="POST" name="btn_submit" class="btn btn-orange w-50 mx-auto d-block mb-5">
                    @error('btn_submit')
                        <p class="text-danger small">{{$message}}</p>
                    @enderror
                </form>
            </div>
            {{-- advertisement --}}
            <div class="col-2">
                @for($i = 0; $i < 2; $i++)
                    <img src="{{asset('images/93e1a9cf543ecd9d8bdaf98c51dc65a5.jpg')}}" alt="" class="w-100 mb-3">
                @endfor
            </div>
        </div>
    </div>
@endsection
