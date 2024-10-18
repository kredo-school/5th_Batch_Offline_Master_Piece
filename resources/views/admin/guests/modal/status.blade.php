<!--Delete Modal -->
{{-- <div class="modal fade" id="delete-guest-test" tabindex="-1" role="dialog" aria-labelledby="modalTitleId"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content border-danger">
            <div class="modal-header">
                <h5 class="modal-title text-danger">
                    <i class="fa-solid fa-trash-can"></i> Delete guest
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this <span class="fw-bold">Guest</span>?
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">
                    Cancel
                </button>
                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
            </div>
        </div>
    </div>
</div> 

<!--Active Modal -->
<div class="modal fade" id="active-guest-test" tabindex="-1" role="dialog" aria-labelledby="modalTitleId"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content border-primary">
            <div class="modal-header">
                <h5 class="modal-title text-primary">
                    <i class="fa-solid fa-trash-can"></i> Active guest
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to active this <span class="fw-bold">Guest</span>?
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">
                    Cancel
                </button>
                <button type="submit" class="btn btn-primary btn-sm">Active</button>
            </div>
        </div>
    </div>
</div> --}}

 
<!-- Delete Modal for User -->
<div class="modal fade" id="delete-user-modal-{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="modalTitleId"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content border-danger">
            <div class="modal-header">
                <h5 class="modal-title text-danger">
                    <i class="fa-solid fa-trash-can"></i> Delete User
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this <span class="fw-bold">{{ $user->name }}</span>?
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">
                    Cancel
                </button>
                <form action="{{ route('admin.guests.destroy', ['user' => $user->id]) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Active Modal for User -->
<div class="modal fade" id="active-user-modal-{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="modalTitleId"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content border-primary">
            <div class="modal-header">
                <h5 class="modal-title text-primary">
                    <i class="fa-solid fa-check-circle"></i> Activate User
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to activate this <span class="fw-bold">{{ $user->name }}</span>?
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">
                    Cancel
                </button>
                <form action="{{ route('admin.guests.restore', ['user' => $user->id]) }}" method="POST">
                    @csrf
                    
                    <button type="submit" class="btn btn-primary btn-sm">Activate</button>
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


