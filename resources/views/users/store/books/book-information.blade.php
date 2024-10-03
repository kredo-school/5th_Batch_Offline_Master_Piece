@extends('layouts.app')

@section('title', 'Book Information')

@section('content')
<a href="{{ url()->previous() }}" class="fw-bold text-decoration-none main-text btn border-0">
    <div class="h2 fw-semibold">
        <i class="fa-solid fa-caret-left"></i>
        <div class="d-inline main-text">Back</div>
    </div>
</a>

<div class="container">
    <div class="d-flex justify-content-center" >
        <form action="{{ route('store.search') }}" class="d-flex">
            @csrf
            <div class="row ms-auto">
                <div class="col pe-0 position-relative">
                    <input type="text" id="searchInput" name="search" class="form-control rounded"
                        style="width: 400px" placeholder="Search books...">
                    <span id="clearButton" class="clearButton" >&times;</span>
                    <script>
                        // 正しいIDを取得
                        const searchInput = document.getElementById('searchInput');
                        const clearBtn = document.getElementById('clearButton');

                        // 入力フィールドのイベントリスナーを設定
                        searchInput.addEventListener('input', function() {
                            if (searchInput.value.length > 0) {
                                clearBtn.style.display = 'inline';  // テキストがあるときはバツ印を表示
                            } else {
                                clearBtn.style.display = 'none';    // テキストがないときは非表示
                            }
                        });

                        // バツ印をクリックしたときの処理
                        clearBtn.addEventListener('click', function() {
                            searchInput.value = '';  // 入力フィールドをクリア
                            clearBtn.style.display = 'none';  // バツ印を非表示
                            searchInput.focus();  // フィールドにフォーカスを戻す
                        });
                    </script>
                </div>
                <div class="col ps-1">
                    <button type="submit" class="btn btn-warning search-icon">
                        <i class="fa-solid fa-magnifying-glass text-white"></i>
                    </button>
                </div>
            </div>
        </form>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('searchInput'); // クラスからIDに変更

            searchInput.addEventListener('focus', function() {
                const rect = searchInput.getBoundingClientRect();
                const offset = window.pageYOffset + rect.top;

                window.scrollTo({
                    top: offset - 50,
                    behavior: 'smooth'
                });
            });
        });
    </script>


    <div class="d-flex justify-content-center mt-5 w-75 mx-auto">
        <div class="bg-white shadow" style="width: 100%; border-radius: 16px;">
            <div class="d-flex" style="height: 440px;">
                <div class="m-5 d-flex align-items-center justify-content-center">
                    <img src="{{ asset('images/649634.png') }}" alt="book-image" class="p-5 border shadow" style="max-width: 100%; height: auto;">
                </div>

                <div class="d-flex justify-content-center align-items-start mt-5 w-50">
                    <div class="table-header">
                        <table>
                            <thead>
                                <tr>
                                    <th>Title</th>
                                </tr>
                                <tr>
                                    <th>Author</th>
                                </tr>
                                <tr>
                                    <th>Publisher</th>
                                </tr>
                                <tr>
                                    <th>Publication Date</th>
                                </tr>
                                <tr>
                                    <th>Price</th>
                                </tr>
                                <tr>
                                    <th>ISBN</th>
                                </tr>
                                <tr>
                                    <th>Inventory</th>
                                </tr>
                            </thead>
                        </table>
                    </div>

                    <div class="table-body">
                        <table>
                            <tbody>
                                <tr>
                                    <td><a href="#">Inochi no Me</a></td>
                                </tr>
                                <tr>
                                    <td><a href="#">Mitsuo Ohe</a></td>
                                </tr>
                                <tr>
                                    <td><a href="#">Iwanami</a></td>
                                </tr>
                                <tr>
                                    <td>10.10.2020</td>
                                </tr>
                                <tr>
                                    <td>¥ 800</td>
                                </tr>
                                <tr>
                                    <td>1234567890123</td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-center m-5">
        <a href="{{ route('store.newOrderConfirm') }}" class="order-button d-block text-decoration-none text-center" style="width: 15%; border-radius: 16px;">
            Order <i class="fa-solid fa-caret-right"></i>
        </a>
    </div>
</div>


    <style>
        .table-header, .table-body {
            flex: 1;
            font-size: 18px;
        }

        .table-header table, .table-body table {
            border-collapse: collapse;
            width: 100%;
        }

        .table-header th, .table-body td {
            padding: 10px;
            text-align: left;
        }

        .table-body td {
            text-align: center;
        }

        .table {
            background-color: white;
        }

        table thead tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        table tbody tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .table-body a {
            color: black;
            text-decoration: none;
        }

        .order-button{
            height: 60px;
            background-color: #D3DD53;
            color: white;
            font-size: 1.5rem;
            font-weight: bold;
            padding: 12px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        .order-button:hover {
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.3);
        }

        .order-button:active {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transform: translateY(2px);
        }


    </style>


@endsection
