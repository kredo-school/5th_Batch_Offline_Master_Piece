@extends('layouts.app')

@section('title', 'Store Search')

@section('content')
    <div class="container">
        <div class="mt-5 d-flex justify-content-center">
            <form action="{{ route('store.search') }}" method="get" class="d-flex">
                <input type="text" id="store-search" name="store_search" class="form-control form-control-sm rounded" style="width: 400px" placeholder="Search books...">
                <button type="button" id="clearButton" class="btn btn-sm position-absolute end-0 top-50 translate-middle-y rounded" style="display: none; right: 30px;">
                    ×
                </button>
                <button type="submit" class="btn rounded store-search mx-1">
                    <i class="fa-solid fa-magnifying-glass text-white rounded"></i>
                </button>
            </form>
        </div>

        <div class="mt-5 d-flex justify-content-center align-items-center">
            <table class="book-information-table table table-striped text-center bg-white shadow mb-5" style="border-radius: 16px; overflow: hidden;">
                <thead style="background-color: #D3DD53;">
                    <th>Image</th>
                    <th>Title</th>
                    <th>Author</th>
w                    <th>Publisher</th>
                    <th>Publication Date</th>
                    <th>Price</th>
                    <th>ISBN</th>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <img src={{ asset("images/649634.png") }} style="width: 50px;">
                        </td>
                        <td>Inochi no Me</td>
                        <td>Mitsho Ohe</td>
                        <td>Iwanami</td>
                        <td>10.10.2020</td>
                        <td>¥ 800</td>
                        <td>1234567890123</td>
                    </tr>
                    <tr>
                        <td>
                            <img src={{ asset("images/649634.png") }} style="width: 50px;">
                        </td>
                        <td>Inochi no Me</td>
                        <td>Mitsho Ohe</td>
                        <td>Iwanami</td>
                        <td>10.10.2020</td>
                        <td>¥ 800</td>
                        <td>1234567890123</td>
                    </tr>
                    <tr>
                        <td>
                            <img src={{ asset("images/649634.png") }} style="width: 50px;">
                        </td>
                        <td>Inochi no Me</td>
                        <td>Mitsho Ohe</td>
                        <td>Iwanami</td>
                        <td>10.10.2020</td>
                        <td>¥ 800</td>
                        <td>1234567890123</td>
                    </tr>
                    <tr>
                        <td>
                            <img src={{ asset("images/649634.png") }} style="width: 50px;">
                        </td>
                        <td>Inochi no Me</td>
                        <td>Mitsho Ohe</td>
                        <td>Iwanami</td>
                        <td>10.10.2020</td>
                        <td>¥ 800</td>
                        <td>1234567890123</td>
                    </tr>
                    <tr>
                        <td>
                            <img src={{ asset("images/649634.png") }} style="width: 50px;">
                        </td>
                        <td>Inochi no Me</td>
                        <td>Mitsho Ohe</td>
                        <td>Iwanami</td>
                        <td>10.10.2020</td>
                        <td>¥ 800</td>
                        <td>1234567890123</td>
                    </tr>
                    <tr>
                        <td>
                            <img src={{ asset("images/649634.png") }} style="width: 50px;">
                        </td>
                        <td>Inochi no Me</td>
                        <td>Mitsho Ohe</td>
                        <td>Iwanami</td>
                        <td>10.10.2020</td>
                        <td>¥ 800</td>
                        <td>1234567890123</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <style>
        .book-information-table {
            width: 80%;
            background-color: white;
        }

        .book-information-table td {
            vertical-align: middle;
            background-color: white;
        }

        .book-information-table th {
            background-color: #D3DD53;
            color: white;
        }
    </style>

@endsection
