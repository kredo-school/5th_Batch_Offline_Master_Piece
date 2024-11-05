<div class="modal fade" id="report-comment-{{ $comment->id }}">
    <div class="modal-dialog modal-lg">
        <div class="modal-content border-danger">
            <div class="modal-header border-danger">
                <h5 class="modal-title h1 fw-bold">
                    <i class="fa-solid fa-circle-exclamation text-danger"></i> Could you please tell us why you reported
                    the comment?
                </h5>
            </div>
            <form action="{{ route('comment.report', $comment) }}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="container-fluid">
                        @forelse ($reasons as $reason)
                            <div class="form-check fs-24">
                                <input type="radio" name="reason" id="reason-{{$reason->id}}" class="form-check-input"
                                    value="{{ $reason->id }}">
                                <label for="reason-{{$reason->id}}"
                                    class="fw-bold form-check-label mb-0">{{ $reason->reason }}</label>
                            </div>

                        @empty
                            <h2 class="mb-0">There aren't any report reasons now, so you can't report.</h2>
                        @endforelse
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Close</button>
                    @if ($reasons->isNotEmpty())
                        <button type="submit" class="btn btn-danger">Report</button>
                    @endif
                </div>
            </form>
        </div>
    </div>
</div>
