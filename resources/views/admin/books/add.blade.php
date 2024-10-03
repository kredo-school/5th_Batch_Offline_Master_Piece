@extends('layouts.app')

@section('title', 'Store Confirm Reservation List')

@section('content')
    <div>
        <a href="{{url()->previous()}}" class="fw-bold text-decoration-none main-text btn border-0">
            <div class="h2 fw-semibold">
                <i class="fa-solid fa-caret-left"></i>
                <div class="d-inline main-text">Back</div>
            </div>
        </a>
    </div>

    <div class="container">
        <div class="card">
            <form action="" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card-header bg-white">
                    <div class="row mt-3 mb-3">
                        <div class="col text-center">
                            <label for="book-cover" class="form-label fw-semibold">Book Cover</label><br>
                            <img src="{{asset('images/649634 copy.png')}}" alt="" class="border shadow mb-3">
                            <input type="file" name="image" id="book-cover" class="form-control w-50 mx-auto">
                        </div>
                        <div class="col">
                            <div class="row mb-3">
                                <div class="col-3">
                                    <label for="title" class="text-capitalize fw-semibold">Title:</label>
                                </div>
                                <div class="col-9">
                                    <input type="text" name="title" id="title" class="form-control">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-3">
                                    <label for="author" class="text-capitalize fw-semibold">author:</label>
                                </div>
                                <div class="col-9">
                                    <input type="text" name="author" id="author" class="form-control">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-3">
                                    <label for="publisher" class="text-capitalize fw-semibold">publisher:</label>
                                </div>
                                <div class="col-9">
                                    <input type="text" name="publisher" id="publisher" class="form-control">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-3">
                                    <label for="publish-date" class="text-capitalize fw-semibold">Publish date:</label>
                                </div>
                                <div class="col-9">
                                    <input type="text" name="publish_date" id="publish-date" class="form-control">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-3">
                                    <label for="description" class="text-capitalize fw-semibold">description:</label>
                                </div>
                                <div class="col-9">
                                    <textarea name="description" id="description" rows="6" class="form-control"></textarea>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-3">
                                    <label for="genre" class="text-capitalize fw-semibold">genre:</label>
                                </div>
                                <div class="col-9">
                                    <select name="genre" id="genre" class="form-control">
                                        <option value="" hidden>Select genre</option>
                                        <option value=""></option>
                                    </select>
                                </div>

                            </div>

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
