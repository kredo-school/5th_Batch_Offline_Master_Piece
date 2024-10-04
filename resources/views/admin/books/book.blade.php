@extends('layouts.app')

@section('content')
    <div>
        <a href="{{ url()->previous() }}" class="fw-bold text-decoration-none main-text btn border-0">
            <div class="h2 fw-semibold">
                <i class="fa-solid fa-caret-left"></i>
                <div class="d-inline main-text">Back</div>
            </div>
        </a>
    </div>
    <div class="upper-container">
        <div class="row align-items-center">
            <div class="col"></div>
            <div class="col-auto">
                <form action="" method="post">
                    @csrf
                    <div class="row align-items-center">
                        <div class="col pe-0 position-relative">
                            <input type="text" id="searchInput" name="search"
                                class="form-control form-control-sm rounded" placeholder=" Search books..."
                                style="width: 400px;">
                            <button type="button" id="clearButton"
                                class="btn btn-sm position-absolute end-0 top-50 translate-middle-y rounded"
                                style="display: none; right: 30px;">
                                x
                            </button>
                        </div>
                        <div class="col ps-1">
                            <button type="submit" class="btn btn-warning btn-sm search-icon">
                                <i class="fa-solid fa-magnifying-glass text-white"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-4">
                <form action="" method="post">
                    @csrf
                    <select class="form-select w-50 mx-auto" aria-label="admin-sort">
                        <option selected>Open sort menu</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                    </select>
                </form>
            </div>
        </div>

        @include('admin.button')
    </div>
    {{-- 以下 --}}
    <div class="genre-container mt-4">
        <div class="row align-items-center">
            <div class="col-8"></div>
            <div class="col">
            </div>
            <div class="col-2">
                <a href="{{ route('admin.addBook') }}" class="btn btn-success" id="addBookBtn"><i
                        class="fa-solid fa-plus"></i> Add Book</a>
            </div>
        </div>
    </div>
    {{-- 間の追加オプション --}}


    <table class="table manage-table border-rounded">
        <thead>
            <tr>
                <th>Title</th>
                <th>Author</th>
                <th>Publisher</th>
                <th>Public Year</th>
                <th>Review</th>
                <th>Price</th>
                <th>Genre</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @for ($i = 0; $i < 5; $i++)
                <tr>
                    <td>shoki</td>
                    <td>motohashi@email</td>
                    <td>21212121</td>
                    <td><i class="fa-regular fa-face-smile"></i></td>
                    <td><i class="fa-regular fa-face-smile"></i></td>
                    <td><i class="fa-regular fa-face-smile"></i></td>
                    <td><i class="fa-regular fa-face-smile"></i></td>
                    <td>
                        @if (1)
                            <a class="btn fs-24 p-0 border-0" data-bs-toggle="modal" data-bs-target="#delete-book-test">
                                <i class="fa-regular fa-face-smile text-primary"></i> Active
                            </a>
                        @else
                            <a class="btn fs-24 p-0 border-0" data-bs-toggle="modal" data-bs-target="#active-book-test">
                                <i class="fa-regular fa-face-frown text-danger"></i> Inactive
                            </a>
                        @endif
                    </td>
                </tr>
            @endfor
        </tbody>
    </table>

    @include('admin.books.modal.status')




    <div class="under-container mt-5">
        <nav aria-label="Page navigation">
            <ul class="pagination justify-content-center">
                <li class="page-item disabled" aria-disabled="true">
                    <a class="page-link" href="#" tabindex="-1" aria-label="Previous">
                        Previous
                    </a>
                </li>
                <li class="page-item"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item">
                    <a class="page-link" href="#" aria-label="Next">
                        Next
                    </a>
                </li>
            </ul>
        </nav>
    </div>
@endsection


{{--
    上部分はrowで分けて作る
    backはrowでくくる
    カードで作れるか
    下はcolで分ければいい
    パジネーとはその下に
    ステータスのアイコンが変わるようにする
    バーはボタンにする

    admin book
    admin store
    これらに飛ぶボタンも作る必要があるか
   　bookのみ rowの行を狭めた方がいいか
   for each使い忘れた。
--}}
