<div class="row list-group list-group-horizontal justify-content-center mt-3">
    <div class="col p-0 text-center">
        <a href="{{route('admin.guests.index')}}" class="list-group-item admin-list rounded-start p-3 h2 main-text fw-semibold {{request()->is('admin/guest*') ? 'active' : ''}}">
            Manage Guest
        </a>
    </div>
    <div class="col p-0 text-center">
        <a href="{{route('admin.stores.show')}}" class="list-group-item admin-list p-3 h2 main-text fw-semibold {{request()->is('admin/store*') ? 'active' : ''}}">
            Manage Store
        </a>
    </div>
    <div class="col p-0 text-center">
        <a href="{{route('admin.genres.show')}}" class="list-group-item admin-list p-3 h2 main-text fw-semibold {{request()->is('admin/genre*') ? 'active' : ''}}">
            Manage Genre
        </a>
    </div>
    <div class="col p-0 text-center">
        <a href="{{route('admin.books.index')}}" class="list-group-item admin-list rounded-end p-3 h2 main-text fw-semibold {{request()->is('admin/book*') ? 'active' : ''}}">
            Manage Book
        </a>
    </div>
</div>
