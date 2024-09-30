@extends('layouts.app')

@section('title', 'ThreadCreate')

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
                <form action="" method="post" enctype="multipart/form-data">
                    @csrf
                    <label for="title" class="form-label fw-semibold">Title <span class="text-danger">*</span></label>
                    <input type="text" name="title" id="title" class="form-control mb-3" placeholder="Title">

                    <label for="genre" class="form-label fw-semibold">Select Genre</label>
                    <div class="mb-3">
                        @for($i = 0; $i < 20; $i++)
                            <div class="form-check form-check-inline">
                                <input type="checkbox" name="fantasy" id="genre" class="form-check-input">
                                <label for="fantasy" class="form-check-label main-text fw-semibold">Fantasy</label>
                            </div>
                        @endfor
                    </div>

                    <label for="genre" class="form-label fw-semibold">First comment <span class="text-danger">*</span></label>
                    <textarea name="comment" id="comment" cols="" rows="8" placeholder="Add comment" class="form-control mb-3"></textarea>

                    <label for="genre" class="form-label fw-semibold">Image file <span class="text-danger">*</span></label>
                    <input type="file" name="image" id="image" class="form-control w-25 mb-5">

                    <input type="submit" value="POST" class="btn btn-orange w-50 mx-auto d-block mb-5">
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
