@extends('layouts.app')

@section('title', 'Thread Create')

@section('content')
    <div class="container-fluid">
        <div class="row">
            {{-- advertisement --}}
            <div class="col-2">
                @for ($i = 0; $i < 2; $i++)
                    <a href="#" class="text-decoration-none text-white">
                        <div class="thread-adv mb-3 bg-adv w-100 ">
                            <p class="h2">Advertisement</p>
                        </div>
                    </a>
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
                                <input type="checkbox" name="genre[]" id="{{$genre->id}}" value="{{$genre->id}}" class="form-check-input" {{is_array(old('genre')) && in_array($genre->id, old('genre')) ? 'checked': ''}}>
                                <label for="{{$genre->id}}" class="form-check-label main-text fw-semibold">{{$genre->name}}</label>
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
                    <input type="file" name="image" id="image" class="form-control w-25">
                    <div id="image-info" class="form-text mb-5">
                        <p class="mb-0">Acceptable formats: jpeg, jpg, png, gif only.</p>
                        <p class="mt-0">Maximum file size is 1048kb.</p>
                        @error('image')
                            <p class="text-danger small">{{$message}}</p>
                        @enderror
                    </div>

                    <input type="submit" value="POST" name="btn_submit" class="btn btn-orange w-50 mx-auto d-block mb-5">
                    @error('btn_submit')
                        <p class="text-danger small">{{$message}}</p>
                    @enderror
                </form>
            </div>
            {{-- advertisement --}}
            <div class="col-2">
                @for ($i = 0; $i < 2; $i++)
                    <a href="#" class="text-decoration-none text-white">
                        <div class="thread-adv mb-3 bg-adv w-100 ">
                            <p class="h2">Advertisement</p>
                        </div>
                    </a>
                @endfor
            </div>
        </div>
    </div>
@endsection
