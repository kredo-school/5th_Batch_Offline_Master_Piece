@extends('layouts.app')

@section('content')

                <div class="upper-container">
                        <div class="row  row align-items-center">
                                <div class="col-4">
                                    <button type="button" class="btn btn-lg">
                                        <a href="" class="text-decoration-none back ms-4"><i class="fa-solid fa-caret-left"></i> <label for="">Back</label></a> 
                                    </button>    
                                </div>
                                <div class="col-5">
                                    <div class="row">
                                        <div class="input-search search-bar ">
                                            <input type="text" class="col-8 rounded search-input" placeholder="  search users">
                                                <button type="submit" class="btn btn-warning btn-sm search-icon col">
                                                    <i class="fa-solid fa-magnifying-glass text-white"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                    <div class="col-3">
                                        <select class="form-select" aria-label="admin-sort">
                                            <option selected>Open sort menu</option>
                                            <option value="1">One</option>
                                            <option value="2">Two</option>
                                            <option value="3">Three</option>
                                        </select>
                                    </div>
                        </div>
            
                        <div class="row mt-4 text-center justify-content-center">
                            <div class="btn-group group-admin-button text-decoration-none" role="group" aria-label="group">
                                <button type="button" class="btn col-3  d-flex align-items-center justify-content-center">
                                    <p class="manage m-0">Manage Guest</p>
                                </button>
                                <button type="button" class="btn btn-outline col-3 d-flex align-items-center justify-content-center  ">
                                    <p class="manage m-0">Manage Store</p>
                                </button>
                                <button type="button" class="btn btn-outline col-3 d-flex align-items-center justify-content-center  ">
                                    <p class="manage m-0">Manage Genre</p>
                                </button>
                                <button type="button" class="btn btn-outline col-3 d-flex align-items-center justify-content-center disabled disabled-admin manage-store-btn">
                                    <p class="manage m-0">Manage Book</p>
                                </button>
                            </div>
                        </div>  
                </div>
        {{-- 以下 --}}
        <div class="genre-container mt-4">
            <div class="row align-items-center">
                <div class="col-8"></div>
                <div class="col">
                    <input type="text" class="form-control" placeholder="Add new book" id="bookInput">
                </div>
                <div class="col-2">
                    <button type="button" class="btn btn-success" id="addBookBtn">Add Book</button>
                </div>
            </div>
        </div>
        {{-- 間の追加オプション --}}
        
            
            <table class="table manage-table border-rounded">
                <thead>
                    <tr >
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
                            <td><i class="fa-regular fa-face-smile"></i></td>
                        </tr>
                    @endfor
                </tbody>
            </table>
        


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
