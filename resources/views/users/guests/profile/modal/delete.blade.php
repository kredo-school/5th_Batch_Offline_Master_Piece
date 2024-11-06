@if (isset($comment))
    <div class="modal fade" id="delete-comment-{{$comment->id}}">
        <div class="modal-dialog">
            <div class="modal-content border-danger">
                <div class="modal-header border-danger">
                    <h5 class="modal-title text-danger">
                        <i class="fa-solid fa-trash-can"></i> Delete comment
                    </h5>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this <span class="fw-bold">Comment</span>?
                </div>
                <div class="modal-footer border-0">
                    <form action="{{ route('comment.destroy', $comment->id) }}" method="post">
                        @csrf
                        @method('DELETE')

                        <button type="button" class="btn btn-outline-danger btn-sm" data-bs-dismiss="modal">
                            Cancel
                        </button>

                        <button type="submit" class="btn btn-danger btn-sm">
                            Delete
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endif
