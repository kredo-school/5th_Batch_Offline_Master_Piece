<div class="modal fade" id="genre-modal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content border-0  genre-modal-bg w-75 p-3">
            <div class="modal-header border-secoondaryr">
                <h5 class="modal-title text-secondary ps-4 p-0">
                    Select Genre
                </h5>
            </div>
            <form action="{{ route('genreHome') }}" method="post">
                @csrf

                @if ($all_genres->isEmpty())
                    <div class="modal-body d-flex justify-content-center">
                        <p class="h3">No genre yet</p>
                    </div>
                @else
                    <div class="modal-body text-secondary mx-auto d-flex flex-column flex-wrap" style="height: 300px;">
                        @foreach ($all_genres as $genre)
                            <div class="form-check">
                                <input class="form-check-input  checkbox-item" name="genres[]" type="checkbox"
                                    value="{{ $genre->id }}" id="defaultCheck{{ $loop->iteration }}">
                                <label class="form-check-label" for="defaultCheck{{ $loop->iteration }}">
                                    {{ $genre->name }}
                                </label>
                            </div>
                        @endforeach
                    </div>
                    <div class="text-end">
                        <input type="checkbox" id="selectAll" class="form-check-input">
                        <label class="form-check-label" for="selectAll">Select All</label>
    
                    </div>
                @endif

                <button type="submit" class="btn btn-warning text-white mt-2 w-100">Search</button>
            </form>
        </div>
    </div>
</div>

<script>
    // 全選択機能
    document.getElementById('selectAll').addEventListener('click', function(event) {
        const checkboxes = document.querySelectorAll('.checkbox-item');
        const isChecked = event.target.checked;

        checkboxes.forEach(function(checkbox) {
            checkbox.checked = isChecked;
        });
    });

    // 個別のチェックボックスが外されたら「全選択」も外れる機能
    const individualCheckboxes = document.querySelectorAll('.checkbox-item');

    individualCheckboxes.forEach(function(checkbox) {
        checkbox.addEventListener('click', function() {
            const allChecked = document.querySelectorAll('.checkbox-item:checked').length ===
                individualCheckboxes.length;
            document.getElementById('selectAll').checked = allChecked;
        });
    });
</script>
