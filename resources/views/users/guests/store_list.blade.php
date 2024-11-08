@extends('layouts.app')

@section('title', 'Book Inventory')

@section('content')
<form action="{{ route('book.store_list') }}" method="GET">
    @csrf
    <div class="mb-5 d-flex justify-content-center mx-auto">
        <select name="area" id="area" class="form-select w-25">
            <option value="All" {{ request('area') == 'All' ? 'selected' : '' }}>All Area</option>
            @foreach ($prefectures as $prefecture)
                <option value="{{ $prefecture }}" {{ request('area') == $prefecture ? 'selected' : '' }}>{{ $prefecture }}</option>
            @endforeach
        </select>

        <div class="row ms-3">
            <div class="col">
                <div class="row ms-auto">
                    <div class="col pe-0 position-relative">
                        <input type="text" id="searchInput" name="search"
                            class="form-control form-control-sm searchInput" 
                            style="height: calc(2em + .75rem + 2px); width: 400px;"
                            value="{{ request('search') }}" placeholder="Search Stores...">
                            <span id="clearButton" class="clearButton">&times;</span>
                    </div>
                    <div class="col ps-1">
                        <button type="submit" class="btn btn-warning search-icon btn-sm"
                                style="height: calc(2em + .75rem + 2px);">
                            <i class="fa-solid fa-magnifying-glass text-white"></i>
                        </button>
                    </div>
                </div>

            </div>
        </div>


    </div>
</form>



        <div class="container-body p-5" style="overflow-y: auto; height: 650px;">
            <h1 class="h3 main-text fw-bold">Select Store</h1>
            @foreach ($stores as $store)
                <div class="row ms-3">
                    <div class="col-4">
                        <a href="{{ route('book.store_show',$store->id) }}" class="link-book">
                            @if (optional($store->profile)->avatar)
                            <img src="{{optional($store->profile)->avatar}}"
                                alt="store name: {{ $store->name }}" class="img-store-inventory">
                                @else
                                <img src="https://th.bing.com/th/id/OIP.Khe4un4CrKghna_BBciHDgHaHa?w=148&h=180&c=7&r=0&o=5&dpr=2&pid=1.7" alt="#" class="img-store-inventory">
                            @endif
                        </a>
                    </div>

                    <div class="col-4 my-auto text-decoration-none text-black">
                        <a href="{{ route('book.store_show',$store->id) }}" class="link-book">
                            <h3>{{$store->name}}</h3>
                            <h5>{{optional($store->profile)->phone_number}}</h5>
                            <h4>{{optional($store->profile)->address}}</h4>
                        </a>
                    </div>

                    <div class="col-4 my-auto">
                    </div>
                </div>
                <hr>
            @endforeach
        </div>


    <script>
        // エリアを選択したときに即時にフォームを送信
        document.getElementById('area').addEventListener('change', function() {
            this.form.submit(); // プルダウン選択時に自動でフォームを送信
        });
    
        検索バーの入力によって即時にフォーム送信しないように調整
        document.getElementById('searchInput').addEventListener('input', function() {
            const searchValue = this.value.toLowerCase();
            const clearButton = document.getElementById('clearButton');
        });
            

    </script>
    
@endsection
