<!--Delete Modal -->
<div class="modal fade" id="delete-book-modal-{{ $book->id }}" tabindex="-1" role="dialog" aria-labelledby="modalTitleId"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content border-danger">
            <div class="modal-header">
                <h5 class="modal-title text-danger">
                    <i class="fa-solid fa-trash-can"></i> Delete Book
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this <span class="fw-bold">Book</span>?
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">
                    Cancel
                </button>
                {{-- <button type="submit" class="btn btn-danger btn-sm">Delete</button> --}}
                <form action="{{route('admin.books.destroy',$book->id)}}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!--Active Modal -->
<div class="modal fade" id="active-book-modal-{{ $book->id }}" tabindex="-1" role="dialog" aria-labelledby="modalTitleId"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content border-primary">
            <div class="modal-header">
                <h5 class="modal-title text-primary">
                    <i class="fa-solid fa-trash-can"></i> Active Book
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to active this <span class="fw-bold">{{$book->title}}</span>?
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">
                    Cancel
                </button>
                {{-- <button type="submit" class="btn btn-primary btn-sm">Active</button> --}}
                <form action="{{route('admin.books.restore',$book->id)}}" method="post">
                    @csrf
                    <button type="submit" class="btn btn-primary btn-sm">Active</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    var modalId = document.getElementById('modalId');

    modalId.addEventListener('show.bs.modal', function(event) {
        // Button that triggered the modal
        let button = event.relatedTarget;
        // Extract info from data-bs-* attributes
        let recipient = button.getAttribute('data-bs-whatever');

        // Use above variables to manipulate the DOM
    });
</script>


