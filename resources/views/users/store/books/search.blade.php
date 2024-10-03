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
        <div class="d-flex justify-content-center">
            <form action="{{ route('store.search') }}" method="get" class="d-flex">
                <input type="text" id="store-search" name="store_search" class="form-control form-control-sm rounded search-bar" style="width: 400px" placeholder="Search books...">
                <button type="button" id="clearButton" class="btn btn-sm position-absolute end-0 top-50 translate-middle-y rounded" style="display: none; right: 30px;">
                    ×
                </button>
                <button type="submit" class="btn rounded store-search mx-1">
                    <i class="fa-solid fa-magnifying-glass text-white rounded"></i>
                </button>
            </form>
        </div>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const searchBar = document.querySelector('.search-bar');

                searchBar.addEventListener('focus', function() {
                    const rect = searchBar.getBoundingClientRect();
                    const offset = window.pageYOffset + rect.top;

                    window.scrollTo({
                        top: offset - 50,
                        behavior: 'smooth'
                    });
                });
            });
        </script>

        <div class="mt-5 d-flex justify-content-center align-items-center m-auto" style="width: 90%;">
            <table class="book-information-table table table-striped text-center shadow mb-5">
                <thead>
                    <th style="width: 10%;">Image</th>
                    <th style="width: 15%;">Title</th>
                    <th style="width: 15%;">Author</th>
                    <th style="width: 15%;">Publisher</th>
                    <th style="width: 15%;">Publication Date</th>
                    <th style="width: 10%;">Price</th>
                    <th style="width: 20%;">ISBN</th>
                </thead>
                <tbody>
                    <tr onclick="window.location='{{ route('store.bookInformation') }}';" style="cursor: pointer;">
                        <td style="width: 10%;">
                            <img src={{ asset("images/649634.png") }} style="width: 50px;">
                        </td>
                        <td style="width: 15%;">Inochi no Me</td>
                        <td style="width: 15%;">Mitsho Ohe</td>
                        <td style="width: 15%;">Iwanami</td>
                        <td style="width: 15%;">10.10.2020</td>
                        <td style="width: 10%;">¥ 800</td>
                        <td style="width: 20%;">1234567890123</td>
                    </tr>
                    <tr onclick="window.location='{{ route('store.bookInformation') }}';" style="cursor: pointer;">
                        <td style="width: 10%;">
                            <img src={{ asset("images/649634.png") }} style="width: 50px;">
                        </td>
                        <td style="width: 15%;">Inochi no Me</td>
                        <td style="width: 15%;">Mitsho Ohe</td>
                        <td style="width: 15%;">Iwanami</td>
                        <td style="width: 15%;">10.10.2020</td>
                        <td style="width: 10%;">¥ 800</td>
                        <td style="width: 20%;">1234567890123</td>
                    </tr>
                    <tr onclick="window.location='{{ route('store.bookInformation') }}';" style="cursor: pointer;">
                        <td style="width: 10%;">
                            <img src={{ asset("images/649634.png") }} style="width: 50px;">
                        </td>
                        <td style="width: 15%;">Inochi no Me</td>
                        <td style="width: 15%;">Mitsho Ohe</td>
                        <td style="width: 15%;">Iwanami</td>
                        <td style="width: 15%;">10.10.2020</td>
                        <td style="width: 10%;">¥ 800</td>
                        <td style="width: 20%;">1234567890123</td>
                    </tr>
                    <tr onclick="window.location='{{ route('store.bookInformation') }}';" style="cursor: pointer;">
                        <td style="width: 10%;">
                            <img src={{ asset("images/649634.png") }} style="width: 50px;">
                        </td>
                        <td style="width: 15%;">Inochi no Me</td>
                        <td style="width: 15%;">Mitsho Ohe</td>
                        <td style="width: 15%;">Iwanami</td>
                        <td style="width: 15%;">10.10.2020</td>
                        <td style="width: 10%;">¥ 800</td>
                        <td style="width: 20%;">1234567890123</td>
                    </tr>
                    <tr onclick="window.location='{{ route('store.bookInformation') }}';" style="cursor: pointer;">
                        <td style="width: 10%;">
                            <img src={{ asset("images/649634.png") }} style="width: 50px;">
                        </td>
                        <td style="width: 15%;">Inochi no Me</td>
                        <td style="width: 15%;">Mitsho Ohe</td>
                        <td style="width: 15%;">Iwanami</td>
                        <td style="width: 15%;">10.10.2020</td>
                        <td style="width: 10%;">¥ 800</td>
                        <td style="width: 20%;">1234567890123</td>
                    </tr>
                    <tr onclick="window.location='{{ route('store.bookInformation') }}';" style="cursor: pointer;">
                        <td style="width: 10%;">
                            <img src={{ asset("images/649634.png") }} style="width: 50px;">
                        </td>
                        <td style="width: 15%;">Inochi no Me</td>
                        <td style="width: 15%;">Mitsho Ohe</td>
                        <td style="width: 15%;">Iwanami</td>
                        <td style="width: 15%;">10.10.2020</td>
                        <td style="width: 10%;">¥ 800</td>
                        <td style="width: 20%;">1234567890123</td>
                    </tr>
                    <tr onclick="window.location='{{ route('store.bookInformation') }}';" style="cursor: pointer;">
                        <td style="width: 10%;">
                            <img src={{ asset("images/649634.png") }} style="width: 50px;">
                        </td>
                        <td style="width: 15%;">Inochi no Me</td>
                        <td style="width: 15%;">Mitsho Ohe</td>
                        <td style="width: 15%;">Iwanami</td>
                        <td style="width: 15%;">10.10.2020</td>
                        <td style="width: 10%;">¥ 800</td>
                        <td style="width: 20%;">1234567890123</td>
                    </tr>
                    <tr onclick="window.location='{{ route('store.bookInformation') }}';" style="cursor: pointer;">
                        <td style="width: 10%;">
                            <img src={{ asset("images/649634.png") }} style="width: 50px;">
                        </td>
                        <td style="width: 15%;">Inochi no Me</td>
                        <td style="width: 15%;">Mitsho Ohe</td>
                        <td style="width: 15%;">Iwanami</td>
                        <td style="width: 15%;">10.10.2020</td>
                        <td style="width: 10%;">¥ 800</td>
                        <td style="width: 20%;">1234567890123</td>
                    </tr>
                    <tr onclick="window.location='{{ route('store.bookInformation') }}';" style="cursor: pointer;">
                        <td style="width: 10%;">
                            <img src={{ asset("images/649634.png") }} style="width: 50px;">
                        </td>
                        <td style="width: 15%;">Inochi no Me</td>
                        <td style="width: 15%;">Mitsho Ohe</td>
                        <td style="width: 15%;">Iwanami</td>
                        <td style="width: 15%;">10.10.2020</td>
                        <td style="width: 10%;">¥ 800</td>
                        <td style="width: 20%;">1234567890123</td>
                    </tr>
                    <tr onclick="window.location='{{ route('store.bookInformation') }}';" style="cursor: pointer;">
                        <td style="width: 10%;">
                            <img src={{ asset("images/649634.png") }} style="width: 50px;">
                        </td>
                        <td style="width: 15%;">Inochi no Me</td>
                        <td style="width: 15%;">Mitsho Ohe</td>
                        <td style="width: 15%;">Iwanami</td>
                        <td style="width: 15%;">10.10.2020</td>
                        <td style="width: 10%;">¥ 800</td>
                        <td style="width: 20%;">1234567890123</td>
                    </tr>
                    <tr onclick="window.location='{{ route('store.bookInformation') }}';" style="cursor: pointer;">
                        <td style="width: 10%;">
                            <img src={{ asset("images/649634.png") }} style="width: 50px;">
                        </td>
                        <td style="width: 15%;">Inochi no Me</td>
                        <td style="width: 15%;">Mitsho Ohe</td>
                        <td style="width: 15%;">Iwanami</td>
                        <td style="width: 15%;">10.10.2020</td>
                        <td style="width: 10%;">¥ 800</td>
                        <td style="width: 20%;">1234567890123</td>
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
