<!-- admin/reports/report.blade.php -->

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
                        <form action="{{ route('admin.reports.search') }}" style="width: 500px" class="d-flex"
                            method="get">
                            <div class="row ms-auto">
                                <div class="col pe-0 position-relative">
                                    <input type="text" id="searchInput" name="search"
                                        class="form-control form-control-sm rounded searchInput" style="width: 400px"
                                        value="{{ request('search') }}" placeholder="Search reports...">
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
                <form id="sortForm" action="{{ route('admin.reports.index') }}" method="get">
                    <div class="d-flex justify-content-center align-items-center">
                        <select class="form-select w-50 me-2" aria-label="admin-sort" id="manage-report-select"
                            name="sort">
                            <option value="created_at" {{ request('sort') == 'created_at' ? 'selected' : '' }}>Reported at
                            </option>
                            <option value="name" {{ request('sort') == 'name' ? 'selected' : '' }}>Reporter</option>
                            <option value="reason" {{ request('sort') == 'reason' ? 'selected' : '' }}>Reason</option>
                            <option value="comment" {{ request('sort') == 'comment' ? 'selected' : '' }}>Comment</option>
                        </select>

                        <select class="form-select w-50" aria-label="sort-order" id="sort-order-select" name="order">
                            <option value="asc" {{ request('order') == 'asc' ? 'selected' : '' }}>↑ Ascending</option>
                            <option value="desc" {{ request('order') == 'desc' ? 'selected' : '' }}>↓ Descending</option>
                        </select>
                    </div>
                </form>
            </div>
        </div>
        @include('admin.button')
    </div>

    <div class="report-container mt-4">
        <form action="{{ route('admin.reports.store') }}" method="post">
            @csrf

            <div class="row align-items-center">
                <div class="col-8"></div>
                <div class="col">
                    <input type="text" name="reason" class="form-control" placeholder="Add new reason" id="reportInput">
                </div>
                <div class="col-2">
                    <button type="submit" class="btn btn-success" id="addreportBtn"><i class="fa-solid fa-plus"></i>Add Reason</button>
                </div>
            </div>
        </form>
        @error('reason')
            <p class="text-end text-danger small mt-3" style="margin-right: 8em;">{{$message}}</p>
        @enderror
    </div>

    <table class="table manage-table border-rounded" id="manage-report-table">
        <thead>
            <tr>
                <th>Reported at</th>
                <th>Reported user</th>
                <th>Reason</th>
                <th>Comment</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @if ($reports->isEmpty())
                <tr>
                    <td colspan="5" class="text-center">No reports found</td>
                </tr>
            @else
                @foreach ($reports as $report)
                    <tr>
                        <td>{{ $report->created_at }}</td>
                        <td>{{ $report->user->name }}</td>
                        <td>{{ $report->reason->reason }}</td>
                        <td>
                            @if (strlen($report->comment->body) > 40)
                                <span class="short-text">
                                    <a
                                        href="{{ route('thread.content', ['thread' => $report->comment->thread->id, 'targetCommentId' => $report->comment->id]) }}#comment-{{ $report->comment->id }}">
                                        {{ \Illuminate\Support\Str::limit($report->comment->body, 40, '') }}
                                        <!-- 初期の50文字を表示 -->
                                    </a>
                                    <span class="more-link" onclick="toggleText(this)">...more</span>
                                </span>
                                <span class="full-text" style="display: none;">
                                    <a
                                        href="{{ route('thread.content', ['thread' => $report->comment->thread->id, 'targetCommentId' => $report->comment->id]) }}#comment-{{ $report->comment->id }}">
                                        {{ $report->comment->body }} <!-- 全文表示 -->
                                    </a>

                                </span>
                            @else
                                <a
                                    href="{{ route('thread.content', ['thread' => $report->comment->thread->id, 'targetCommentId' => $report->comment->id]) }}#comment-{{ $report->comment->id }}">
                                    {{ $report->comment->body }} <!-- 全文表示 -->
                                </a>
                            @endif

                        </td>
                        <td class="text-center">
                            <a class="btn fs-24 p-0 border-0 " data-bs-toggle="modal"
                                data-bs-target="#delete-report-modal-{{ $report->id }}">
                                <i class="fa-solid fa-trash-can text-danger"></i>
                            </a>
                        </td>
                    </tr>
                    @include('admin.reports.modals.delete-report')
                @endforeach
            @endif
        </tbody>
    </table>

    <div class="d-flex justify-content-center">
        {{ $reports->appends(['sort' => request('sort'), 'order' => request('order'), 'search' => request('search')])->links() }}
    </div>

    <div>
        <h2 class="ms-5 main-text fw-bold">All reasons</h2>
        <table class="table manage-table border-rounded">
            <thead>
                <tr>
                    <th style="width: 100px">id</th>
                    <th>Reason</th>
                    <th style="width: 100px"></th>
                </tr>
            </thead>
            <tbody class="align-middle">
                @if ($all_reasons->isEmpty())
                    <tr>
                        <td colspan="5" class="text-center">No reasons found</td>
                    </tr>
                @else
                    @foreach ($all_reasons as $reason)
                        <tr>
                            <td>{{ $reason->id }}</td>
                            <td>{{ $reason->reason }}</td>
                            <td class="text-center">
                                <a class="btn fs-24 p-0 border-0 " data-bs-toggle="modal"
                                    data-bs-target="#delete-reason-modal-{{ $reason->id }}">
                                    <i class="fa-solid fa-trash-can text-danger"></i>
                                </a>
                            </td>
                        </tr>
                        @include('admin.reports.modals.delete-reason')
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>

    <script>
        document.getElementById('manage-report-select').addEventListener('change', function() {
            document.getElementById('sortForm').submit();
        });

        document.getElementById('sort-order-select').addEventListener('change', function() {
            document.getElementById('sortForm').submit();
        });


        document.addEventListener("DOMContentLoaded", function() {
            const anchor = window.location.hash;
            if (anchor.startsWith("#comment-")) {
                const commentId = anchor.replace("#comment-", "");
                const targetElement = document.querySelector(`[data-comment-id='${commentId}']`);
                if (targetElement) {
                    targetElement.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            }
        });


        function toggleText(element) {
            const shortText = element.closest('td').querySelector('.short-text');
            const fullText = element.closest('td').querySelector('.full-text');

            // `shortText`と`fullText`の表示を切り替え
            if (shortText.style.display === 'none') {
                shortText.style.display = '';
                fullText.style.display = 'none';
            } else {
                shortText.style.display = 'none';
                fullText.style.display = '';
            }
        }
    </script>


@endsection
