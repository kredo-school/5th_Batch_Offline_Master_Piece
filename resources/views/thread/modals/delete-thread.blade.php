<div class="modal fade" id="delete-thread-{{$thread->id}}">
    <div class="modal-dialog">
        <div class="modal-content border-danger">
            <div class="modal-header border-danger">
                <h5 class="modal-title text-danger">
                    <i class="fa-solid fa-circle-exclamation"></i> Delete thread
                </h5>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <p class="text-danger">Are you sure you want to delete this thread?</p>
                </div>
            </div>
            <div class="modal-footer">
                <form action="{{route('thread.destroyThread', $thread)}}" method="post">
                    @csrf
                    @method('DELETE')
                        <button type="button" class="btn btn-outline-danger btn-sm" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>
