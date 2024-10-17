@extends('layouts.app')

@section('title','SHOW_STORE')

@section('content')
    {{-- Back button --}}
    <div>
        <a href="{{url()->previous()}}" class="fw-bold text-decoration-none main-text btn border-0">
            <div class="h2 fw-semibold">
                <i class="fa-solid fa-caret-left"></i>
                <div class="d-inline main-text">Back</div>
            </div>
        </a>
    </div>

    <form action="{{ route('book.store_list') }}" method="get">
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
                        @csrf
                        <div class="row ms-auto">
                            <div class="col pe-0 position-relative">
                                <input type="text" id="searchInput" name="search" class="form-control rounded searchInput"
                                    value="{{ request('search') }}" style="width: 400px" placeholder="Search stores...">
                                    <span id="clearButton" class="clearButton">&times;</span>
                            </div>
                            <div class="col ps-1">
                                <button type="submit" class="btn btn-warning search-icon">
                                    <i class="fa-solid fa-magnifying-glass text-white"></i>
                                </button>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </form>
        <div class="container-body ps-5">
            <h1 class="h3 main-text fw-bold">Store Information</h1>
            <div class="row ms-3 my-5">
                <div class="col-3">
                    <a href="{{ route('book.store_show',$store->id) }}" class="link-book">
                        @if (optional($store->profile)->avatar)
                        <img src="{{optional($store->profile)->avatar}}"
                            alt="store name: {{ $store->name }}" class="img-store-inventory">
                            @else
                            <img src="https://th.bing.com/th/id/OIP.Khe4un4CrKghna_BBciHDgHaHa?w=148&h=180&c=7&r=0&o=5&dpr=2&pid=1.7" alt="#" class="img-store-inventory">
                        @endif
                    </a>
                </div>
                <div class=" col my-auto ms-5">
                    <a href="{{ route('book.store_show',$store->id) }}" class="link-book">
                        <h3>{{$store->name}}</h3>
                        <h5>{{optional($store->profile)->phone_number}}</h5>
                        <h4>{{optional($store->profile)->address}}</h4>
                    </a>
                </div>
            </div>
            <h4 class="ms-3">Introduction:</h4>
            <h5 class="ms-5">{{optional($store->profile)->introduction}}</h5>
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
