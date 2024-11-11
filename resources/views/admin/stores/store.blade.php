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
            <div class="row ms-3">
                <div class="col">
                    <form action="{{ route('admin.stores.search') }}" style="width: 500px" class="d-flex" method="get">
                        @csrf
                        <div class="row ms-auto">
                            <div class="col pe-0 position-relative">
                                <input type="text" id="searchInput" name="search" class="form-control form-control-sm rounded searchInput"
                                    style="width: 400px" value="{{ request('search') }}" placeholder="Search stores...">
                                    <span id="clearButton" class="clearButton">&times;</span>
                            </div>
                            <div class="col ps-1">
                                <button type="submit" class="btn btn-warning search-icon btn-sm">
                                    <i class="fa-solid fa-magnifying-glass text-white"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

            <div class="col-4 ">
                <form action="{{ route('admin.stores.show') }}" method="get" id="sortForm" class="d-flex">
                    @csrf
                    <select class="form-select w-50 me-2" aria-label="admin-sort" id="manage-store-select" name="sort">
                        <option value="name" {{ request('sort') == 'name' ? 'selected' : '' }}>Name</option>
                        <option value="phone_number" {{ request('sort') == 'phone_number' ? 'selected' : '' }}>Phone</option>
                        <option value="address" {{ request('sort') == 'address' ? 'selected' : '' }}>Address</option>
                        <option value="status" {{ request('sort') == 'status' ? 'selected' : '' }}>Status</option>
                    </select>
            
                    <select class="form-select w-50 me-2" aria-label="book-order" id="sort-order-select" name="order">
                        <option value="asc" {{ request('order') == 'asc' ? 'selected' : '' }}>↑ Ascending</option>
                        <option value="desc" {{ request('order') == 'desc' ? 'selected' : '' }}>↓ Descending</option>
                    </select>
            
                    <select name="address" id="" class="form-select w-50" onchange="this.form.submit()">
                        <option value="" hidden>Address</option>
                        @foreach ($prefectures as $prefecture)
                            <option value="{{ $prefecture }}" {{ request('address') == $prefecture ? 'selected' : '' }}>
                                {{ $prefecture }}
                            </option>
                        @endforeach
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
            <a href="{{ route('admin.registerStore') }}" class="btn btn-success" id="addBookBtn"><i
                    class="fa-solid fa-plus"></i> Add Store</a>
        </div>
    </div>
</div>
{{-- 間の追加オプション --}}


{{-- テーブル --}}
<table class="table manage-table border-rounded" id="manage-store-table">
    <thead>
        <tr>
            <th></th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Address</th>
            <th class="text-center">Status</th>
        </tr>
    </thead>

    <tbody>
        @if (empty($stores))
    <tr>
        <td colspan="6" class="text-center">No stores found</td>
    </tr>
        @else
    @foreach ($stores as $store)
    <tr>
        <td>
            @if ($store->profile)
            <img src="{{ $store->profile->avatar }}" alt="{{ $store->id }}" class="rounded-circle d-block mx-auto avatar-md" style="width: 50px; height: 50px; object-fit: cover;">
        @else
            <i class="fa-solid fa-circle-user d-block text-center icon-md" style="font-size: 50px;"></i>
        @endif
        </td>
        <td>
            {{$store->name}}
        </td>
        <td>
            {{$store->email}}
        </td>
        <td>
            @if ($store->profile)
                {{ $store->profile->phone_number }}
            @else
                <p class="text-danger">Not available</p>
            @endif

        </td>
        <td>
            @if ($store->profile)
                {{ $store->profile->address }}
            @else
                <p class="text-danger">Not available</p>
            @endif
        </td>
        <td class="text-center">
            @if ($store->trashed())
                <a class="btn fs-24 p-0 border-0" data-bs-toggle="modal" data-bs-target="#active-store-modal-{{ $store->id }}">
                    <i class="fa-regular fa-face-frown text-danger"></i> Inactive
                </a>
            @else
                <a class="btn fs-24 p-0 border-0" data-bs-toggle="modal" data-bs-target="#delete-store-modal-{{ $store->id }}">
                    <i class="fa-regular fa-face-smile text-primary"></i> Active
                </a>
            @endif
        </td>
            </tr>
            @include('admin.stores.modals.status')
            @endforeach
            @endif
    </tbody>
</table>

{{-- name address stutus --}}

<script>
    document.getElementById('manage-store-select').addEventListener('change', function() {
        document.getElementById('sortForm').submit();
    });

    document.getElementById('sort-order-select').addEventListener('change', function() {
        document.getElementById('sortForm').submit();
    });
</script>


{{-- ページネーション --}}
<div class="d-flex justify-content-center">
    {{ $stores->links() }}
</div>

@endsection

