<div class="row list-group list-group-horizontal justify-content-center mt-3">
    <div class="col p-0 text-center">
        <a href="{{route('admin.guests.index')}}" class="list-group-item admin-list rounded-start p-3 h2 main-text fw-semibold {{request()->is('admin/guest*') ? 'active' : ''}}">
            Guest
        </a>
    </div>
    <div class="col p-0 text-center">
        <a href="{{route('admin.stores.show')}}" class="list-group-item admin-list p-3 h2 main-text fw-semibold {{request()->is('admin/store*') ? 'active' : ''}}">
            Store
        </a>
    </div>
    <div class="col p-0 text-center">
        <a href="{{route('admin.genres.show')}}" class="list-group-item admin-list p-3 h2 main-text fw-semibold {{request()->is('admin/genre*') ? 'active' : ''}}">
            Genre
        </a>
    </div>
    <div class="col p-0 text-center">
        <a href="{{route('admin.books.index')}}" class="list-group-item admin-list p-3 h2 main-text fw-semibold {{request()->is('admin/book*') ? 'active' : ''}}">
            Book
        </a>
    </div>
    <div class="col p-0 text-center">
        <a href="{{route('admin.reports.index')}}" class="list-group-item admin-list rounded-end p-3 h2 main-text fw-semibold {{request()->is('admin/report*') ? 'active' : ''}}">
            Report
        </a>
    </div>
</div>
