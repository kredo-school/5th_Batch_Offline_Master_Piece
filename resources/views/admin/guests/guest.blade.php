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
                        <form action="{{ route('admin.guests.search') }}" style="width: 500px" class="d-flex" method="get">
                            @csrf
                            <div class="row ms-auto">
                                <div class="col pe-0 position-relative">
                                    <input type="text" id="searchInput" name="search" class="form-control form-control-sm rounded searchInput"
                                        style="width: 400px" value="{{ request('search') }}" placeholder="Search guests...">
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
            <div class="col-4">
                <form id="sortForm" action="{{ route('admin.guests.index') }}" method="get">
                    @csrf
                    <div class="d-flex justify-content-center align-items-center">
                        <select class="form-select w-50 me-2" aria-label="admin-sort" id="manage-guest-select" name="sort" onchange="this.form.submit()">
                            <option value="name" {{ request('sort') == 'name' ? 'selected' : '' }}>Name</option>
                            <option value="report" {{ request('sort') == 'report' ? 'selected' : '' }}>Report</option>
                            <option value="status" {{ request('sort') == 'status' ? 'selected' : '' }}>Status</option>
                        </select>
            
                        <select class="form-select w-50" aria-label="sort-order" id="sort-order-select" name="order" onchange="this.form.submit()">
                            <option value="asc" {{ request('order') == 'asc' ? 'selected' : '' }}>↑ Ascending</option>
                            <option value="desc" {{ request('order') == 'desc' ? 'selected' : '' }}>↓ Descending</option>
                        </select>
                    </div>
                </form>
            </div>
            
        </div>
        @include('admin.button')
    </div>


    <table class="table manage-table border-rounded" id="manage-guest-table">
        <thead>
            <tr>
                <th></th>
                <th>Name</th>
                <th>Email</th>
                <th >Report</th>
                <th >Status</th>
                {{-- <th>Actions</th> --}}
            </tr>
        </thead>
        <tbody>
            @if ($all_users->isEmpty())
                <tr>
                    <td colspan="4" class="text-center">No guests found</td>
                </tr>
            @else
                @foreach ($all_users as $user)
                <tr>
                <td>
                    @if ($user->profile)
                        <img src="{{ $user->profile->avatar }}" alt="{{ $user->id }}" class="rounded-circle d-block mx-auto avatar-md" style="width: 50px; height: 50px; object-fit: cover;">
                    @else
                        <i class="fa-solid fa-circle-user d-block text-center icon-md" style="font-size: 50px;"></i>
                    @endif
                </td>
                <td>
                    <a href="{{ route('profile.show', $user->id) }}" class="text-decoration-none text-dark fw-bold">{{ $user->name }}</a>
                </td>
                <td>{{ $user->email }}</td>
                <td class="text-danger">{{ $user->thread_report_count ?? 0 }}</td>
                
                <td>
                        @if ($user->trashed())
                            <a class="btn fs-24 p-0 border-0" data-bs-toggle="modal" data-bs-target="#active-user-modal-{{ $user->id }}">
                                <i class="fa-regular fa-face-frown text-danger"></i> Inactive
                            </a>
                        @else
                            <a class="btn fs-24 p-0 border-0" data-bs-toggle="modal" data-bs-target="#delete-user-modal-{{ $user->id }}">
                                <i class="fa-regular fa-face-smile text-primary"></i> Active
                            </a>
                        @endif
                </td>

                </td>
            </tr>
            @include('admin.guests.modal.status')
            @endforeach
            @endif
        </tbody>
    </table>  

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script>
        // セレクトメニューが変更されたときに自動的にフォームを送信
        // document.getElementById('manage-guest-select').addEventListener('change', function() {
        //     document.getElementById('sortForm').submit();
        // });
        
        // document.getElementById('sort-order-select').addEventListener('change', function() {
        //     document.getElementById('sortForm').submit();
        // });

        document.getElementById('manage-guest-select').addEventListener('change', function() {
        document.getElementById('sortForm').submit();
        });

        document.getElementById('sort-order-select').addEventListener('change', function() {
        document.getElementById('sortForm').submit();
        });

        
    </script>




    {{-- ページネーションリンクを表示 --}}
    <div class="d-flex justify-content-center">
        {{ $all_users->appends(['sort' => request('sort'), 'order' => request('order'), 'search' => request('search')])->links() }}
    </div>

@endsection

