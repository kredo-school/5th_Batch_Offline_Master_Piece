<div class="row justify-content-center mb-3">
    <div class="col-auto"><img src="{{ asset('images/BB2BB7F8-CA14-4C2A-8606-2DA9E432FEB0 copy.png') }}" alt=""
            class="thread-img"></div>
    <div class="col-auto">
        <h1 class="thread-title">Threads about Books</h1>
    </div>
</div>

<div class="row ms-3">
    <div class="col-10">

        <div class="row mb-5">
            <div class="col">
                <form action="" method="post">
                    @csrf
                    <select name="genre" id="genre" class="form-select w-50">
                        <option value="" hidden>Genre</option>
                        <option value="1">genre</option>
                        <option value="2">genre</option>
                    </select>
                </form>
            </div>
            <div class="col">
                {{-- not complete --}}
                <form action="#" style="width: 500px" class="d-flex">
                    @csrf
                    <div class="row ms-auto">
                        <div class="col pe-0 position-relative">
                            <input type="text" id="searchInput" name="search" class="form-control rounded"
                                style="width: 400px" placeholder="Search threads..." style="width: 250px;">
                            <button type="button" id="clearButton"
                                class="btn btn-sm position-absolute end-0 top-50 translate-middle-y rounded"
                                style="display: none; right: 30px;">
                                x
                            </button>
                        </div>
                        <div class="col ps-1">
                            <button type="submit" class="btn btn-warning search-icon">
                                <i class="fa-solid fa-magnifying-glass text-white"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>

    <div class="col-2">
        @if(request()->is('thread/content'))
            <div class="text-end">
                <a href="#comment" class=" text-dark h3">
                    <i class="fa-solid fa-pen-to-square"></i> Add comment
                </a>
            </div>
        @endif
    </div>
</div>
