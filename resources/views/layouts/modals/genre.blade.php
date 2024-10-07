<div class="modal fade" id="genre-modal">
    <div class="modal-dialog ">
        <div class="modal-content border-0  genre-modal-bg w-75">
            <div class="modal-header border-secoondaryr">
                <h5 class="modal-title text-secondary ps-4 p-0">
                    Select Genre
                </h5>
            </div>
            <div class="modal-body text-secondary mx-auto">
                <form action="#" method="post" class="ms-0 mt-3 p-0">
                    @csrf
                    <div class="row ms-0">
                        <div class="col">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="Comic"
                                    id="defaultCheck1">
                                <label class="form-check-label" for="defaultCheck1">
                                    Comic
                                </label>
                            </div>

                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="Fantasy"
                                    id="defaultCheck2">
                                <label class="form-check-label" for="defaultCheck2">
                                    Fantasy
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="Horror"
                                    id="defaultCheck3">
                                <label class="form-check-label" for="defaultCheck3">
                                    Horror
                                </label>
                            </div>

                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="Mystey"
                                    id="defaultCheck4">
                                <label class="form-check-label" for="defaultCheck4">
                                    Mystey
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="History"
                                    id="defaultCheck5">
                                <label class="form-check-label" for="defaultCheck5">
                                    History
                                </label>
                            </div>
                        </div>
                        <div class="col"></div>
                        <div class="col"></div>
                        <div class="col"></div>
                        <div class="col"></div>
                        <div class="col me-5">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="Literature"
                                    id="defaultCheck6">
                                <label class="form-check-label" for="defaultCheck6">
                                    Literature
                                </label>
                            </div>

                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="Kids"
                                    id="defaultCheck7">
                                <label class="form-check-label" for="defaultCheck7">
                                    Kids
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="Travel"
                                    id="defaultCheck8">
                                <label class="form-check-label" for="defaultCheck8">
                                    Travel
                                </label>
                            </div>

                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="Sports"
                                    id="defaultCheck9">
                                <label class="form-check-label" for="defaultCheck9">
                                    Sports
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="Study"
                                    id="defaultCheck10">
                                <label class="form-check-label" for="defaultCheck10">
                                    Study
                                </label>
                            </div>
                        </div>
                    </div>


                    <button type="submit"
                        class="btn btn-warning text-white mx-auto mt-5 w-100">Search</button>
                </form>

            </div>
        </div>
    </div>
</div>
