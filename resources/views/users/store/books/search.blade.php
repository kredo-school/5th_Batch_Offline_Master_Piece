@extends('layouts.app')

@section('title', 'Store Search')

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

        <div class="mt-4 h5" style="margin-left: 5%;">Search results: <span class="fw-bold">10</span> books</div>

        <div class="d-flex justify-content-center align-items-center m-auto" style="width: 90%;">
            <table class="book-information-table table table-striped text-center shadow mb-5">
                <thead>
                    <th style="width: 5%;">No.</th>
                    <th style="width: 10%;">Image</th>
                    <th style="width: 15%;">Title</th>
                    <th style="width: 15%;">Author</th>
                    <th style="width: 15%;">Publisher</th>
                    <th style="width: 15%;">Publication Date</th>
                    <th style="width: 10%;">Price</th>
                    <th style="width: 15%;">ISBN</th>
                </thead>
                <tbody>
                    <tr onclick="window.location='{{ route('store.bookInformation') }}';" style="cursor: pointer;">
                        <td style="width: 5%;">1</td>
                        <td style="width: 10%;">
                            <img src={{ asset("images/649634.png") }} style="width: 50px;">
                        </td>
                        <td style="width: 15%;">Inochi no Me</td>
                        <td style="width: 15%;">Mitsho Ohe</td>
                        <td style="width: 15%;">Iwanami</td>
                        <td style="width: 15%;">10.10.2020</td>
                        <td style="width: 10%;">¥ 800</td>
                        <td style="width: 15%;">1234567890123</td>
                    </tr>
                    <tr onclick="window.location='{{ route('store.bookInformation') }}';" style="cursor: pointer;">
                        <td style="width: 5%;">2</td>
                        <td style="width: 10%;">
                            <img src={{ asset("images/649634.png") }} style="width: 50px;">
                        </td>
                        <td style="width: 15%;">Inochi no Me</td>
                        <td style="width: 15%;">Mitsho Ohe</td>
                        <td style="width: 15%;">Iwanami</td>
                        <td style="width: 15%;">10.10.2020</td>
                        <td style="width: 10%;">¥ 800</td>
                        <td style="width: 15%;">1234567890123</td>
                    </tr>
                    <tr onclick="window.location='{{ route('store.bookInformation') }}';" style="cursor: pointer;">
                        <td style="width: 5%;">3</td>
                        <td style="width: 10%;">
                            <img src={{ asset("images/649634.png") }} style="width: 50px;">
                        </td>
                        <td style="width: 15%;">Inochi no Me</td>
                        <td style="width: 15%;">Mitsho Ohe</td>
                        <td style="width: 15%;">Iwanami</td>
                        <td style="width: 15%;">10.10.2020</td>
                        <td style="width: 10%;">¥ 800</td>
                        <td style="width: 15%;">1234567890123</td>
                    </tr>
                    <tr onclick="window.location='{{ route('store.bookInformation') }}';" style="cursor: pointer;">
                        <td style="width: 5%;">4</td>
                        <td style="width: 10%;">
                            <img src={{ asset("images/649634.png") }} style="width: 50px;">
                        </td>
                        <td style="width: 15%;">Inochi no Me</td>
                        <td style="width: 15%;">Mitsho Ohe</td>
                        <td style="width: 15%;">Iwanami</td>
                        <td style="width: 15%;">10.10.2020</td>
                        <td style="width: 10%;">¥ 800</td>
                        <td style="width: 15%;">1234567890123</td>
                    </tr>
                    <tr onclick="window.location='{{ route('store.bookInformation') }}';" style="cursor: pointer;">
                        <td style="width: 5%;">5</td>
                        <td style="width: 10%;">
                            <img src={{ asset("images/649634.png") }} style="width: 50px;">
                        </td>
                        <td style="width: 15%;">Inochi no Me</td>
                        <td style="width: 15%;">Mitsho Ohe</td>
                        <td style="width: 15%;">Iwanami</td>
                        <td style="width: 15%;">10.10.2020</td>
                        <td style="width: 10%;">¥ 800</td>
                        <td style="width: 15%;">1234567890123</td>
                    </tr>
                    <tr onclick="window.location='{{ route('store.bookInformation') }}';" style="cursor: pointer;">
                        <td style="width: 5%;">6</td>
                        <td style="width: 10%;">
                            <img src={{ asset("images/649634.png") }} style="width: 50px;">
                        </td>
                        <td style="width: 15%;">Inochi no Me</td>
                        <td style="width: 15%;">Mitsho Ohe</td>
                        <td style="width: 15%;">Iwanami</td>
                        <td style="width: 15%;">10.10.2020</td>
                        <td style="width: 10%;">¥ 800</td>
                        <td style="width: 15%;">1234567890123</td>
                    </tr>
                    <tr onclick="window.location='{{ route('store.bookInformation') }}';" style="cursor: pointer;">
                        <td style="width: 5%;">7</td>
                        <td style="width: 10%;">
                            <img src={{ asset("images/649634.png") }} style="width: 50px;">
                        </td>
                        <td style="width: 15%;">Inochi no Me</td>
                        <td style="width: 15%;">Mitsho Ohe</td>
                        <td style="width: 15%;">Iwanami</td>
                        <td style="width: 15%;">10.10.2020</td>
                        <td style="width: 10%;">¥ 800</td>
                        <td style="width: 15%;">1234567890123</td>
                    </tr>
                    <tr onclick="window.location='{{ route('store.bookInformation') }}';" style="cursor: pointer;">
                        <td style="width: 5%;">8</td>
                        <td style="width: 10%;">
                            <img src={{ asset("images/649634.png") }} style="width: 50px;">
                        </td>
                        <td style="width: 15%;">Inochi no Me</td>
                        <td style="width: 15%;">Mitsho Ohe</td>
                        <td style="width: 15%;">Iwanami</td>
                        <td style="width: 15%;">10.10.2020</td>
                        <td style="width: 10%;">¥ 800</td>
                        <td style="width: 15%;">1234567890123</td>
                    </tr>
                    <tr onclick="window.location='{{ route('store.bookInformation') }}';" style="cursor: pointer;">
                        <td style="width: 5%;">9</td>
                        <td style="width: 10%;">
                            <img src={{ asset("images/649634.png") }} style="width: 50px;">
                        </td>
                        <td style="width: 15%;">Inochi no Me</td>
                        <td style="width: 15%;">Mitsho Ohe</td>
                        <td style="width: 15%;">Iwanami</td>
                        <td style="width: 15%;">10.10.2020</td>
                        <td style="width: 10%;">¥ 800</td>
                        <td style="width: 15%;">1234567890123</td>
                    </tr>
                    <tr onclick="window.location='{{ route('store.bookInformation') }}';" style="cursor: pointer;">
                        <td style="width: 5%;">10</td>
                        <td style="width: 10%;">
                            <img src={{ asset("images/649634.png") }} style="width: 50px;">
                        </td>
                        <td style="width: 15%;">Inochi no Me</td>
                        <td style="width: 15%;">Mitsho Ohe</td>
                        <td style="width: 15%;">Iwanami</td>
                        <td style="width: 15%;">10.10.2020</td>
                        <td style="width: 10%;">¥ 800</td>
                        <td style="width: 15%;">1234567890123</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <style>
        .book-information-table {
            width: 100%;
            table-layout: fixed;"

        }
        .book-information-table thead {
            display: table;
            width: 100%;
            background-color: #D3DD53;

        }

        .book-information-table td {
            vertical-align: middle;
            background-color: white;
            font-size: 1rem;
        }

        .book-information-table th {
            background-color: #D3DD53;
            color: white;
        }

        .book-information-table tbody {
            display: block;
            max-height: 612px;
            overflow-y: scroll;
            width: 100%;"
        }

        .book-information-table tr{
            display: table;
            width: 100%;
            table-layout: fixed;"
        }
    </style>

@endsection
