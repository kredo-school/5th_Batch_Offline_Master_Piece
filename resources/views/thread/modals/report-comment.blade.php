<div class="modal fade" id="report-comment-postid">
    <div class="modal-dialog modal-lg">
        <div class="modal-content border-danger">
            <div class="modal-header border-danger">
                <h5 class="modal-title h1 fw-bold">
                    <i class="fa-solid fa-circle-exclamation text-danger"></i> Could you please tell us why you reported
                    the comment?
                </h5>
            </div>
            <form action="" method="post">
                @csrf
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="form-check fs-24">
                            <input type="checkbox" name="spam" id="reason" class="form-check-input">
                            <label for="spam" class="fw-bold form-check-label mb-0">Spam</label>
                        </div>
                        <div class="form-check fs-24">
                            <input type="checkbox" name="spam" id="reason" class="form-check-input">
                            <label for="spam" class="fw-bold form-check-label mb-0">Harassment</label>
                        </div>
                        <div class="form-check fs-24">
                            <input type="checkbox" name="spam" id="reason" class="form-check-input">
                            <label for="spam" class="fw-bold form-check-label mb-0">Inappropriate Content</label>
                        </div>
                        <div class="form-check fs-24">
                            <input type="checkbox" name="spam" id="reason" class="form-check-input">
                            <label for="spam" class="fw-bold form-check-label mb-0">Hate Speech</label>
                        </div>
                        <div class="form-check fs-24">
                            <input type="checkbox" name="spam" id="reason" class="form-check-input">
                            <label for="spam" class="fw-bold form-check-label mb-0">Privacy Violation</label>
                        </div>
                        <div class="form-check fs-24">
                            <input type="checkbox" name="spam" id="reason" class="form-check-input">
                            <label for="spam" class="fw-bold form-check-label mb-0">Copyright Violation</label>
                        </div>
                        <div class="form-check fs-24">
                            <input type="checkbox" name="spam" id="reason" class="form-check-input">
                            <label for="spam" class="fw-bold form-check-label mb-0">False Information</label>
                        </div>
                        <div class="form-check fs-24">
                            <input type="checkbox" name="spam" id="reason" class="form-check-input">
                            <label for="spam" class="fw-bold form-check-label mb-0">Promotion of Illegal
                                Activities</label>
                        </div>
                        <div class="form-check fs-24">
                            <input type="checkbox" name="spam" id="reason" class="form-check-input">
                            <label for="spam" class="fw-bold form-check-label mb-0">Violence or Suicide
                                Promotion</label>
                        </div>
                        <div class="form-check fs-24">
                            <input type="checkbox" name="spam" id="reason" class="form-check-input">
                            <label for="spam" class="fw-bold form-check-label mb-0">Inappropriate Language</label>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger">Report</button>
                </div>
            </form>
        </div>
    </div>
</div>
