@extends('layouts.app')

@section('title','Book Inventory')

@section('content')
    {{-- Back button --}}
    <div>
        <a href="{{ url()->previous() }}" class="fw-bold text-decoration-none main-text btn border-0">
            <div class="h2 fw-semibold">
                <i class="fa-solid fa-caret-left"></i>
                <div class="d-inline main-text">Back</div>
            </div>
        </a>
    </div>

    <div class="container-body">
        <div class="row">
            <div class="col-1"></div>
            <div class="col-3">
                <a href="{{ route('book.show_book', $book->id) }}">
                    <img src="{{ $book->image }}" alt="book image {{$book->id}}" class="w-100 shadow">
                </a>
            </div>
            <div class="col-1"></div>
            <div class="col-7 fs-32">
                <p>
                    <a href="{{ route('book.show_book', $book->id) }}" class="link-book">
                        <div class="fs-32">{{ $book->title }}</div>
                    </a>
                    <div>
                        @foreach ($book->authors as $author)
                            <a href="{{ route('book.author_show', $author->id) }}" class="link-book">{{ $author->name }}</a>
                        @endforeach
                    </div>
                    <div class="mt-3">
                        @php
                            $averageStarCount = $book->reviews->avg('star_count');
                            $fullStars = floor($averageStarCount); // 満点の数
                            $halfStar = $averageStarCount - $fullStars >= 0.1; // 半点があるか
                            $emptyStars = 5 - $fullStars - ($halfStar ? 1 : 0); // 残りの星
                        @endphp
                        {{-- 満点の星を表示 --}}
                        @for ($i = 0; $i < $fullStars; $i++)
                            <i class="fa-solid fa-star text-warning"></i>
                        @endfor
                        
                        {{-- 半点の星を表示 --}}
                        @if ($halfStar)
                            <i class="fa-solid fa-star-half-stroke text-warning"></i>
                        @endif
                        
                        {{-- 未満の星を表示 --}}
                        @for ($i = 0; $i < $emptyStars; $i++)
                            <i class="fa-regular fa-star text-warning"></i>
                        @endfor

                        {{ number_format($averageStarCount, 1) }}/5.0
                    </div>
                </p>
                <h3 class="d-flex mt-4">Price:<div class="text-danger"> ¥ {{ floor($book->price) }}</div></h3>
            </div>
        </div>
    </div>


    <div class="row mb-5 d-flex justify-content-center mx-auto w-75">
        <div class="col">
            <div>
                <form id="filterForm" action="{{ route('book.inventory', $book->id) }}" method="get">
                    @csrf
                    <select name="address" class="form-select w-75 ms-3" onchange="this.form.submit()">
                        <option value="All Area" {{ $selectedPrefecture == 'All Area' ? 'selected' : '' }}>All Area</option>
                        @foreach ($prefectures as $prefecture)
                            <option value="{{ $prefecture }}" {{ $selectedPrefecture == $prefecture ? 'selected' : '' }}>
                                {{ $prefecture }}
                            </option>
                        @endforeach
                    </select>
                </form>
            </div>
        </div>
    
        <div class="col">
            <div>
                <form action="{{ route('book.inventory', $book->id) }}" method="get">
                    @csrf
                    <div class="row ms-auto">
                        <div class="col pe-0 position-relative">
                            <input type="text" id="searchInput" name="search" class="form-control rounded searchInput"
                                value="{{ $searchQuery }}" style="width: 400px" placeholder="Search stores...">
                            <span id="clearButton" class="clearButton" onclick="clearSearch()">&times;</span>
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
    
    <script>
        function clearSearch() {
            document.getElementById('searchInput').value = '';
            document.getElementById('filterForm').submit();
        }
    </script>
    

    <form id="bookInventoryForm" action="{{ route('book.reserve.add', $book->id) }}" method="POST">
        @csrf
        
        <div class="container-body" id="storeList">
            @foreach ($storeLists as $store)
                <div class="row ms-3">
                    <!-- store_id を配列で保持 -->
                    <input type="hidden" name="store_ids[]" value="{{ $store->id }}">

                    <div class="col-4 d-flex justify-content-center align-items-center">
                        <a href="{{ route('book.store_show', $store->id) }}" class="link-book img-store-inventory">
                            @if (optional($store->profile)->avatar)
                                <img src="{{ optional($store->profile)->avatar }}" alt="store name: {{ $store->name }}" class="img-store-inventory">
                            @else
                                <img src="https://th.bing.com/th/id/OIP.Khe4un4CrKghna_BBciHDgHaHa?w=148&h=180&c=7&r=0&o=5&dpr=2&pid=1.7" alt="#" class="img-store-inventory">
                            @endif
                        </a>
                    </div>


                    <div class="col-4 my-auto text-black">
                        <a href="{{ route('book.store_show', $store->id) }}" class="link-book">
                            <h3>{{ $store->name }}</h3>
                            <h5>{{ optional($store->profile)->phone_number }}</h5>
                            <h4>{{ optional($store->profile)->address }}</h4>
                        </a>
                    </div>

                    <div class="col-4 my-auto">
                        @php
                            $inventory = $counts->get($store->id)->total_count ?? 0;
                        @endphp
                        <h2>Inventory: {{ $inventory }}</h2>

                        @if($inventory > 0)
                            <h5>Receiving Date: Right Now</h5>
                        @else
                            <h5 class="text-danger">Receiving Date: 3 days later</h5>
                        @endif

                        <!-- 店舗ごとの数量入力 -->
                        <input type="number" name="quantities[{{ $store->id }}]" data-inventory="{{ $inventory }}" 
                            class="form-control quantity-input" placeholder="Quantity" min="0" >
                    </div>
                </div>
                <hr>
            @endforeach
        </div>

        <div class="text-end w-75 mx-auto">
            <button type="button" class="btn btn-primary btn-select-inventory mb-5" 
                    id="selectbutton" 
                    data-store-id="{{ $store->id }}"> 
                Select
            </button>        
        </div>
        
        @include('users.guests.book.modals.inventory')
        
    </form>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // PHPから店舗数を取得
            const storeCount = @json($storeLists->count());
            const storeName  = @json($store->name);
    
            // ボタンのクリックイベントを設定
            const button = document.getElementById('selectbutton');
            button.addEventListener('click', function (event) {
                event.preventDefault(); // デフォルトの送信を防ぐ
    
                const quantityInputs = document.querySelectorAll('input[name^="quantities["]');
                const overInventoryStores = []; // 在庫を超えた店舗を格納する配列
                let showModal = false;
    
                // 各store_idについてループ
                quantityInputs.forEach((quantityInput) => {
                    const storeIdMatch = quantityInput.name.match(/\[(\d+)\]/);
                    const storeId = storeIdMatch ? storeIdMatch[1] : null;
    
                    if (storeId) {
                        const quantity = parseInt(quantityInput.value) || 0;
                        const inventory = parseInt(quantityInput.dataset.inventory) || 0;
    
                        // モーダル表示の条件
                        if (quantity > inventory) {
                            showModal = true;
                            overInventoryStores.push(`Store ${storeName}: Required ${quantity}, Available ${inventory}`);
                        }
                    } else {
                        console.error(`store_id が見つかりません`);
                    }
                });
    
                if (showModal) {
                    // モーダルメッセージを設定
                    const modalMessage = document.getElementById('modalMessage');
                    modalMessage.textContent = `More input than INVENTORY:\n${overInventoryStores.join('\n')}`;
    
                    const modal = new bootstrap.Modal(document.getElementById('quantityErrorModal'));
                    modal.show();  // Modalを表示
                } else {
                    const form = button.closest('form');
                    form.submit(); // 条件を満たす場合に送信
                }
            });
        });
    </script>


    <script>
        document.getElementById('area').addEventListener('change', function() {
            const area = this.value;
            const bookId = {{ $book->id }};
            
            fetch(`/book/inventory/${bookId}?area=${area}`)
            .then(data => {
                const storeListDiv = document.getElementById('storeList');
                storeListDiv.innerHTML = ''; // 既存のリストをクリア

                data.stores.forEach(store => {
                    // 店舗情報を表示するためのHTMLを作成
                    const inventory = data.counts[store.id] ? data.counts[store.id].total_count : 0; // 在庫数を取得
                    const storeItem = document.createElement('div');
                    storeItem.innerHTML = `
                        <h3>${store.name}</h3>
                        <h4>Inventory: ${inventory}</h4>
                    `; // 店舗名と在庫数を表示
                    storeListDiv.appendChild(storeItem);
                });
            });
        });
    </script>
@endsection
